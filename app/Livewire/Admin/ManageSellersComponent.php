<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSellersComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $status = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function approve(int $id): void
    {
        $u = User::with('sellerProfile')->findOrFail($id);
        $u->sellerProfile?->update(['status' => 'approved']);
        session()->flash('success', 'Seller disetujui.');
    }

    public function reject(int $id): void
    {
        $u = User::with('sellerProfile')->findOrFail($id);
        $u->sellerProfile?->update(['status' => 'rejected']);
        session()->flash('success', 'Seller ditolak.');
    }

    public function destroy(int $id): void
    {
        $u = User::where('role', 'seller')->findOrFail($id);
        $u->delete();
        session()->flash('success', 'Seller dihapus.');
    }

    #[Title('Kelola Seller - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $query = User::with('sellerProfile')
            ->where('role', 'seller')
            ->when($this->search !== '', function ($q) {
                $q->where(function ($qq) {
                    $qq->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->when($this->status !== '', function ($q) {
                $q->whereHas('sellerProfile', fn ($qq) => $qq->where('status', $this->status));
            });

        return view('livewire.admin.manage-sellers-component', [
            'sellers' => $query->latest()->paginate(10),
        ]);
    }
}
