<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    #[Layout('layouts.dashboard')]
    #[Title('My Orders')]
    public function render()
    {
        return view('livewire.buyer.orders-component', [
            'orders' => Order::with('items')->where('buyer_id', auth()->id())->latest()->get(),
        ]);
    }
}
