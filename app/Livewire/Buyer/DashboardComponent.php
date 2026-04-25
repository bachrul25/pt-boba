<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'buyer';

    #[Layout('layouts.dashboard')]
    #[Title('Buyer Dashboard - PT BOBA')]
    public function render()
    {
        $u = auth()->user();

        return view('livewire.buyer.dashboard-component', [
            'totalOrders' => Order::where('buyer_id', $u->id)->count(),
            'totalRequests' => ServiceRequest::where('buyer_id', $u->id)->count(),
            'recentOrders' => Order::where('buyer_id', $u->id)->latest()->take(5)->get(),
            'recentRequests' => ServiceRequest::where('buyer_id', $u->id)->with('service')->latest()->take(5)->get(),
            'featuredProducts' => Product::with('brand')->where('is_active', true)->latest()->take(6)->get(),
            'featuredServices' => Service::with('brand')->where('is_active', true)->take(3)->get(),
        ]);
    }
}
