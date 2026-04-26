<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use App\Services\XenditService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Throwable;

class OrdersComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'buyer';

    public function cancel(int $id): void
    {
        $o = Order::where('buyer_id', auth()->id())->find($id);
        if ($o && in_array($o->status, ['pending', 'paid'])) {
            $o->update(['status' => 'cancelled']);
            session()->flash('msg', 'Order dibatalkan.');
        }
    }

    public function pay(int $id, XenditService $xendit)
    {
        $order = Order::where('buyer_id', auth()->id())->find($id);
        if (! $order || $order->status === 'cancelled' || $order->payment_status === 'PAID') {
            return null;
        }

        if ($order->payment_url && in_array($order->payment_status, ['PENDING', null], true)) {
            return $this->redirect($order->payment_url);
        }

        try {
            $url = $xendit->createInvoiceFor($order->fresh());

            return $this->redirect($url);
        } catch (Throwable $e) {
            Log::error('Xendit createInvoice (order) failed: '.$e->getMessage());
            session()->flash('error', 'Gagal membuat invoice Xendit: '.$e->getMessage());

            return null;
        }
    }

    #[Layout('layouts.dashboard')]
    #[Title('My Orders')]
    public function render()
    {
        return view('livewire.buyer.orders-component', [
            'orders' => Order::with('items')->where('buyer_id', auth()->id())->latest()->get(),
        ]);
    }
}
