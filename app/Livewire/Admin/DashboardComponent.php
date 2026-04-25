<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use App\Models\InvestorInquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    #[Layout('layouts.dashboard')]
    #[Title('Admin Dashboard - PT BOBA')]
    public function render()
    {
        return view('livewire.admin.dashboard-component', [
            'totalBuyers' => User::where('role', 'buyer')->count(),
            'totalSellers' => User::where('role', 'seller')->count(),
            'totalProducts' => Product::count(),
            'totalServices' => Service::count(),
            'totalBrands' => Brand::count(),
            'totalOrders' => Order::count(),
            'totalServiceRequests' => ServiceRequest::count(),
            'totalInvestorInquiries' => InvestorInquiry::count(),
            'recentOrders' => Order::with('buyer')->latest()->take(5)->get(),
            'recentInquiries' => InvestorInquiry::latest()->take(5)->get(),
        ]);
    }
}
