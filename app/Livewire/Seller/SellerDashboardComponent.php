<?php

namespace App\Livewire\Seller;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class SellerDashboardComponent extends Component
{
    #[Title('Seller Dashboard - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $userId = Auth::id();
        $profile = Auth::user()->sellerProfile;

        $stats = [
            'products' => Product::where('seller_id', $userId)->count(),
            'services' => Service::where('seller_id', $userId)->count(),
            'orders' => OrderItem::where('seller_id', $userId)->count(),
            'bookings' => ServiceBooking::where('seller_id', $userId)->count(),
            'revenue' => (float) OrderItem::where('seller_id', $userId)
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'success'))
                ->sum('subtotal')
                + (float) ServiceBooking::where('service_bookings.seller_id', $userId)
                    ->where('service_bookings.payment_status', 'success')
                    ->join('services', 'services.id', '=', 'service_bookings.service_id')
                    ->sum('services.price'),
        ];

        return view('livewire.seller.seller-dashboard-component', compact('stats', 'profile'));
    }
}
