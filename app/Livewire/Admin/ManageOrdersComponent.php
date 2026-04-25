<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Order;
use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageOrdersComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public string $tab = 'orders';

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
    }

    public function updateOrderStatus(int $id, string $status): void
    {
        Order::find($id)?->update(['status' => $status]);
        session()->flash('msg', 'Status order diperbarui.');
    }

    public function updateRequestStatus(int $id, string $status): void
    {
        ServiceRequest::find($id)?->update(['status' => $status]);
        session()->flash('msg', 'Status service request diperbarui.');
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Transactions')]
    public function render()
    {
        return view('livewire.admin.manage-orders-component', [
            'orders' => Order::with('buyer', 'items')->latest()->get(),
            'requests' => ServiceRequest::with('buyer', 'service')->latest()->get(),
        ]);
    }
}
