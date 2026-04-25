<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    #[Layout('layouts.dashboard')]
    #[Title('My Service Requests')]
    public function render()
    {
        return view('livewire.buyer.service-requests-component', [
            'requests' => ServiceRequest::with('service')->where('buyer_id', auth()->id())->latest()->get(),
        ]);
    }
}
