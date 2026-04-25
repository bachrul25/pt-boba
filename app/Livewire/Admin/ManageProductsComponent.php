<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProductsComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $brand = '';

    #[Url]
    public string $gender = '';

    #[Url]
    public string $status = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $p = Product::findOrFail($id);
        $p->status = $p->status === 'active' ? 'inactive' : 'active';
        $p->save();
        session()->flash('success', 'Status produk diperbarui.');
    }

    public function destroy(int $id): void
    {
        Product::findOrFail($id)->delete();
        session()->flash('success', 'Produk dihapus.');
    }

    #[Title('Kelola Produk - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $query = Product::with('seller')
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->brand !== '', fn ($q) => $q->where('brand', $this->brand))
            ->when($this->gender !== '', fn ($q) => $q->where('gender_category', $this->gender))
            ->when($this->status !== '', fn ($q) => $q->where('status', $this->status));

        return view('livewire.admin.manage-products-component', [
            'products' => $query->latest()->paginate(10),
        ]);
    }
}
