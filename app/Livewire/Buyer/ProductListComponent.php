<?php

namespace App\Livewire\Buyer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $brand = '';

    #[Url]
    public string $gender = '';

    #[Url]
    public string $category = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function addToCart(int $productId): void
    {
        $product = Product::findOrFail($productId);

        $cart = Cart::firstOrNew([
            'buyer_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        $cart->quantity = ($cart->quantity ?? 0) + 1;
        $cart->subtotal = $cart->quantity * $product->price;
        $cart->save();

        session()->flash('success', 'Produk ditambahkan ke keranjang.');
    }

    #[Title('Produk - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $products = Product::with('seller')
            ->where('status', 'active')
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->brand !== '', fn ($q) => $q->where('brand', $this->brand))
            ->when($this->gender !== '', fn ($q) => $q->where('gender_category', $this->gender))
            ->when($this->category !== '', fn ($q) => $q->where('category', 'like', "%{$this->category}%"))
            ->latest()
            ->paginate(9);

        return view('livewire.buyer.product-list-component', compact('products'));
    }
}
