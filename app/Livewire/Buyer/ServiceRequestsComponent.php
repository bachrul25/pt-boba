<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\ServiceRequest;
use App\Services\XenditService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Throwable;

class ServiceRequestsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'buyer';

    public function cancel(int $id): void
    {
        $r = ServiceRequest::where('buyer_id', auth()->id())->find($id);
        if ($r && in_array($r->status, ['pending', 'confirmed'])) {
            $r->update(['status' => 'cancelled']);
            session()->flash('msg', 'Permintaan dibatalkan.');
        }
    }

    public function pay(int $id, XenditService $xendit)
    {
        $req = ServiceRequest::where('buyer_id', auth()->id())->find($id);
        if (! $req || $req->status === 'cancelled' || $req->payment_status === 'PAID') {
            return null;
        }

        if ((float) $req->estimated_price <= 0) {
            session()->flash('error', 'Estimasi harga belum tersedia. Tunggu konfirmasi admin.');

            return null;
        }

        if ($req->payment_url && in_array($req->payment_status, ['PENDING', null], true)) {
            return $this->redirect($req->payment_url);
        }

        try {
            $url = $xendit->createInvoiceFor($req->fresh());

            return $this->redirect($url);
        } catch (Throwable $e) {
            Log::error('Xendit createInvoice (service_request) failed: '.$e->getMessage());
            session()->flash('error', 'Gagal membuat invoice Xendit: '.$e->getMessage());

            return null;
        }
    }

    #[Layout('layouts.dashboard')]
    #[Title('My Service Requests')]
    public function render()
    {
        return view('livewire.buyer.service-requests-component', [
            'requests' => ServiceRequest::with('service')->where('buyer_id', auth()->id())->latest()->get(),
        ]);
    }
}
