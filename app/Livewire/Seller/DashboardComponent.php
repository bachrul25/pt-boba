<?php

namespace App\Livewire\Seller;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'seller';

    #[Layout('layouts.dashboard')]
    #[Title('Seller Dashboard - PT BOBA')]
    public function render()
    {
        $u = auth()->user();
        $myProductIds = Product::where('seller_id', $u->id)->pluck('id');
        $myServiceIds = Service::where('seller_id', $u->id)->pluck('id');

        return view('livewire.seller.dashboard-component', [
            'totalProducts' => $myProductIds->count(),
            'totalServices' => $myServiceIds->count(),
            'totalOrders' => OrderItem::whereIn('product_id', $myProductIds)->distinct('order_id')->count('order_id'),
            'totalRequests' => ServiceRequest::whereIn('service_id', $myServiceIds)->count(),
            'recentOrders' => Order::whereHas('items', fn ($q) => $q->whereIn('product_id', $myProductIds))
                ->with(['buyer', 'items' => fn ($q) => $q->whereIn('product_id', $myProductIds)])
                ->latest()->take(5)->get(),
        ]);
    }
}
