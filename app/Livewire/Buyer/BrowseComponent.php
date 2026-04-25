<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BrowseComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'buyer';

    public string $search = '';

    public ?int $brand_id = null;

    /** @var array<int, array{product_id:int, name:string, price:float, qty:int}> */
    public array $cart = [];

    public bool $checkoutOpen = false;

    public string $shipping_address = '';

    public string $shipping_phone = '';

    public string $notes = '';

    public function mount(): void
    {
        $this->cart = session('cart', []);
        $u = auth()->user();
        $this->shipping_address = $u->address ?? '';
        $this->shipping_phone = $u->phone ?? '';
    }

    public function addToCart(int $productId): void
    {
        $p = Product::find($productId);
        if (! $p || ! $p->is_active) {
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']++;
        } else {
            $this->cart[$productId] = [
                'product_id' => $p->id,
                'name' => $p->name,
                'price' => (float) $p->price,
                'qty' => 1,
            ];
        }
        session()->put('cart', $this->cart);
        session()->flash('msg', "{$p->name} ditambahkan ke keranjang.");
    }

    public function increment(int $productId): void
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']++;
            session()->put('cart', $this->cart);
        }
    }

    public function decrement(int $productId): void
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']--;
            if ($this->cart[$productId]['qty'] <= 0) {
                unset($this->cart[$productId]);
            }
            session()->put('cart', $this->cart);
        }
    }

    public function removeFromCart(int $productId): void
    {
        unset($this->cart[$productId]);
        session()->put('cart', $this->cart);
    }

    public function getCartTotalProperty(): float
    {
        return collect($this->cart)->sum(fn ($i) => $i['price'] * $i['qty']);
    }

    public function startCheckout(): void
    {
        if (empty($this->cart)) {
            $this->addError('cart', 'Keranjang masih kosong.');

            return;
        }
        $this->checkoutOpen = true;
    }

    public function placeOrder()
    {
        $this->validate([
            'shipping_address' => 'required|string|max:500',
            'shipping_phone' => 'required|string|max:30',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (empty($this->cart)) {
            $this->addError('cart', 'Keranjang kosong.');

            return;
        }

        $order = Order::create([
            'order_number' => 'BOBA-'.strtoupper(Str::random(8)),
            'buyer_id' => auth()->id(),
            'total' => $this->cartTotal,
            'status' => 'pending',
            'shipping_address' => $this->shipping_address,
            'shipping_phone' => $this->shipping_phone,
            'notes' => $this->notes,
        ]);

        foreach ($this->cart as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        $this->cart = [];
        session()->forget('cart');
        $this->checkoutOpen = false;

        session()->flash('msg', "Order {$order->order_number} berhasil dibuat.");

        return $this->redirect('/buyer/orders', navigate: false);
    }

    #[Layout('layouts.dashboard')]
    #[Title('Browse Products')]
    public function render()
    {
        $products = Product::with('brand')
            ->where('is_active', true)
            ->whereHas('brand', fn ($q) => $q->where('type', 'fashion'))
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->brand_id, fn ($q) => $q->where('brand_id', $this->brand_id))
            ->latest()->get();

        return view('livewire.buyer.browse-component', [
            'products' => $products,
            'brands' => Brand::where('type', 'fashion')->where('is_active', true)->get(),
        ]);
    }
}
