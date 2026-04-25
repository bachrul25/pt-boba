<?php

namespace App\Livewire\Buyer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailComponent extends Component
{
    public Product $product;

    public int $quantity = 1;

    public function mount(int $id): void
    {
        $this->product = Product::with('seller')->where('status', 'active')->findOrFail($id);
    }

    public function addToCart(): void
    {
        $this->quantity = max(1, (int) $this->quantity);

        $cart = Cart::firstOrNew([
            'buyer_id' => Auth::id(),
            'product_id' => $this->product->id,
        ]);
        $cart->quantity = ($cart->quantity ?? 0) + $this->quantity;
        $cart->subtotal = $cart->quantity * $this->product->price;
        $cart->save();

        session()->flash('success', 'Produk ditambahkan ke keranjang.');
    }

    #[Title('Detail Produk - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.buyer.product-detail-component');
    }
}
