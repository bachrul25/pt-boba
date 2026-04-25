<?php

namespace App\Livewire\Buyer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BuyerDashboardComponent extends Component
{
    #[Title('Buyer Dashboard - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $userId = Auth::id();

        $stats = [
            'cart' => Cart::where('buyer_id', $userId)->sum('quantity'),
            'orders' => Order::where('buyer_id', $userId)->count(),
            'bookings' => ServiceBooking::where('buyer_id', $userId)->count(),
            'spent' => (float) Order::where('buyer_id', $userId)->where('payment_status', 'success')->sum('total_price')
                + (float) ServiceBooking::where('service_bookings.buyer_id', $userId)
                    ->where('service_bookings.payment_status', 'success')
                    ->join('services', 'services.id', '=', 'service_bookings.service_id')
                    ->sum('services.price'),
        ];

        $recentOrders = Order::where('buyer_id', $userId)->latest()->take(5)->get();
        $recentBookings = ServiceBooking::with('service')->where('buyer_id', $userId)->latest()->take(5)->get();

        return view('livewire.buyer.buyer-dashboard-component', compact('stats', 'recentOrders', 'recentBookings'));
    }
}
