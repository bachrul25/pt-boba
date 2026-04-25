<?php

namespace App\Livewire\Seller;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrdersComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'seller';

    public string $tab = 'orders';

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Seller Orders')]
    public function render()
    {
        $u = auth()->user();
        $myProductIds = Product::where('seller_id', $u->id)->pluck('id');
        $myServiceIds = Service::where('seller_id', $u->id)->pluck('id');

        $orders = Order::whereHas('items', fn ($q) => $q->whereIn('product_id', $myProductIds))
            ->with(['buyer', 'items' => fn ($q) => $q->whereIn('product_id', $myProductIds)])
            ->latest()->get();

        $requests = ServiceRequest::whereIn('service_id', $myServiceIds)
            ->with(['buyer', 'service'])
            ->latest()->get();

        return view('livewire.seller.orders-component', compact('orders', 'requests'));
    }
}
