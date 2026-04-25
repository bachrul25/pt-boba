<?php

namespace App\Livewire\Buyer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public string $shipping_address = '';

    public string $payment_method = 'Transfer Bank';

    public string $payment_outcome = 'success'; // simulated

    public ?int $lastOrderId = null;

    public ?string $lastPaymentStatus = null;

    public function mount(): void
    {
        $this->shipping_address = Auth::user()->address ?? '';
    }

    public function placeOrder(): void
    {
        $data = $this->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:Transfer Bank,E-Wallet,COD',
            'payment_outcome' => 'required|in:success,failed',
        ]);

        $items = Cart::with('product')->where('buyer_id', Auth::id())->get();

        if ($items->isEmpty()) {
            session()->flash('error', 'Keranjang kosong.');

            return;
        }

        DB::transaction(function () use ($items, $data) {
            $total = $items->sum('subtotal');

            $order = Order::create([
                'buyer_id' => Auth::id(),
                'total_price' => $total,
                'shipping_address' => $data['shipping_address'],
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_outcome'] === 'success' ? 'success' : 'failed',
                'order_status' => $data['payment_outcome'] === 'success' ? 'processing' : 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'seller_id' => $item->product->seller_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->subtotal,
                ]);
            }

            Payment::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'payment_method' => $data['payment_method'],
                'amount' => $total,
                'status' => $data['payment_outcome'] === 'success' ? 'success' : 'failed',
            ]);

            if ($data['payment_outcome'] === 'success') {
                Cart::where('buyer_id', Auth::id())->delete();
            }

            $this->lastOrderId = $order->id;
            $this->lastPaymentStatus = $data['payment_outcome'];
        });

        if ($this->lastPaymentStatus === 'success') {
            session()->flash('success', 'Pembayaran berhasil! Order #'.$this->lastOrderId.' sedang diproses.');
        } else {
            session()->flash('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }

    public function retryPayment(): void
    {
        if (! $this->lastOrderId) {
            return;
        }

        $order = Order::findOrFail($this->lastOrderId);
        $order->payment_status = 'success';
        $order->order_status = 'processing';
        $order->save();

        Payment::where('order_id', $order->id)->update(['status' => 'success']);
        Cart::where('buyer_id', Auth::id())->delete();

        $this->lastPaymentStatus = 'success';
        session()->flash('success', 'Pembayaran berhasil setelah retry!');
    }

    #[Title('Checkout - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $items = Cart::with('product')->where('buyer_id', Auth::id())->get();
        $total = $items->sum('subtotal');

        return view('livewire.buyer.checkout-component', compact('items', 'total'));
    }
}
