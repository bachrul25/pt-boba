<?php

namespace App\Livewire\Seller;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'seller';

    public ?int $editingId = null;

    public ?int $brand_id = null;

    public string $name = '';

    public string $category = '';

    public string $description = '';

    public string $price = '0';

    public int $stock = 0;

    public bool $is_active = true;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
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
        $p = Product::where('seller_id', auth()->id())->findOrFail($id);
        $this->editingId = $p->id;
        $this->brand_id = $p->brand_id;
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
        $data['seller_id'] = auth()->id();

        if ($this->editingId) {
            $p = Product::where('seller_id', auth()->id())->find($this->editingId);
            $p?->update($data);
        } else {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(4);
            Product::create($data);
        }
        session()->flash('msg', 'Produk disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Product::where('seller_id', auth()->id())->find($id)?->delete();
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
        $this->name = '';
        $this->category = '';
        $this->description = '';
        $this->price = '0';
        $this->stock = 0;
        $this->is_active = true;
    }

    #[Layout('layouts.dashboard')]
    #[Title('My Products')]
    public function render()
    {
        return view('livewire.seller.products-component', [
            'products' => Product::with('brand')->where('seller_id', auth()->id())->latest()->get(),
            'brands' => Brand::where('type', 'fashion')->where('is_active', true)->get(),
        ]);
    }
}
