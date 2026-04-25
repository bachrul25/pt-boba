<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProductsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    use WithPagination;

    public ?int $editingId = null;

    public ?int $brand_id = null;

    public ?int $seller_id = null;

    public string $name = '';

    public string $category = '';

    public string $description = '';

    public string $price = '0';

    public int $stock = 0;

    public bool $is_active = true;

    public bool $showForm = false;

    public string $search = '';

    protected function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'seller_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:160',
            'category' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function newProduct(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $p = Product::findOrFail($id);
        $this->editingId = $p->id;
        $this->brand_id = $p->brand_id;
        $this->seller_id = $p->seller_id;
        $this->name = $p->name;
        $this->category = $p->category ?? '';
        $this->description = $p->description ?? '';
        $this->price = (string) $p->price;
        $this->stock = (int) $p->stock;
        $this->is_active = (bool) $p->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(4);

        if ($this->editingId) {
            $existing = Product::find($this->editingId);
            unset($data['slug']);
            $existing?->update($data);
        } else {
            Product::create($data);
        }
        session()->flash('msg', 'Produk disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Product::find($id)?->delete();
        session()->flash('msg', 'Produk dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->brand_id = null;
        $this->seller_id = null;
        $this->name = '';
        $this->category = '';
        $this->description = '';
        $this->price = '0';
        $this->stock = 0;
        $this->is_active = true;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Products')]
    public function render()
    {
        $products = Product::with(['brand', 'seller'])
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()->paginate(10);

        return view('livewire.admin.manage-products-component', [
            'products' => $products,
            'brands' => Brand::where('type', 'fashion')->get(),
            'sellers' => User::where('role', 'seller')->get(),
        ]);
    }
}
