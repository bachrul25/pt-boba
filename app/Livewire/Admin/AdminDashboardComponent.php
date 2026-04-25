<?php

namespace App\Livewire\Admin;

use App\Models\CompanyStructure;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    #[Title('Admin Dashboard - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $stats = [
            'sellers' => User::where('role', 'seller')->count(),
            'buyers' => User::where('role', 'buyer')->count(),
            'products' => Product::count(),
            'services' => Service::count(),
            'founders' => CompanyStructure::where('status', 'active')->count(),
            'orders' => Order::count(),
            'bookings' => ServiceBooking::count(),
            'payments_success' => Payment::where('status', 'success')->count(),
            'revenue' => (float) Payment::where('status', 'success')->sum('amount'),
        ];

        $recentOrders = Order::with('buyer')->latest()->take(5)->get();
        $recentBookings = ServiceBooking::with(['buyer', 'service'])->latest()->take(5)->get();

        return view('livewire.admin.admin-dashboard-component', compact('stats', 'recentOrders', 'recentBookings'));
    }
}
