<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageSellersComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public string $search = '';

    public function toggleActive(int $id): void
    {
        $u = User::findOrFail($id);
        $u->is_active = ! $u->is_active;
        $u->save();
        session()->flash('msg', "Status seller {$u->name} diperbarui.");
    }

    public function delete(int $id): void
    {
        $u = User::find($id);
        if ($u && $u->isSeller()) {
            $u->delete();
            session()->flash('msg', 'Seller dihapus.');
        }
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Sellers')]
    public function render()
    {
        $sellers = User::where('role', 'seller')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('store_name', 'like', "%{$this->search}%"))
            ->withCount(['products', 'services'])
            ->latest()->get();

        return view('livewire.admin.manage-sellers-component', compact('sellers'));
    }
}
