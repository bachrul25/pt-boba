<?php

namespace App\Livewire\Buyer;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class CartComponent extends Component
{
    public array $quantities = [];

    public function mount(): void
    {
        foreach (Cart::where('buyer_id', Auth::id())->get() as $c) {
            $this->quantities[$c->id] = $c->quantity;
        }
    }

    public function updateQty(int $cartId): void
    {
        $cart = Cart::with('product')->where('buyer_id', Auth::id())->findOrFail($cartId);
        $qty = max(1, (int) ($this->quantities[$cartId] ?? 1));
        $cart->quantity = $qty;
        $cart->subtotal = $qty * $cart->product->price;
        $cart->save();
    }

    public function remove(int $cartId): void
    {
        Cart::where('buyer_id', Auth::id())->findOrFail($cartId)->delete();
        unset($this->quantities[$cartId]);
        session()->flash('success', 'Item dihapus dari keranjang.');
    }

    #[Title('Keranjang - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $items = Cart::with('product.seller')->where('buyer_id', Auth::id())->get();
        $total = $items->sum('subtotal');

        return view('livewire.buyer.cart-component', compact('items', 'total'));
    }
}
