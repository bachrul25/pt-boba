<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageProductsComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $description = '';

    public string $brand = 'tsoecha.co';

    public string $gender_category = 'pria';

    public string $category = '';

    public $price = 0;

    public int $stock = 0;

    public string $status = 'active';

    public $image;

    public ?string $existingImage = null;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:3000',
            'brand' => 'required|in:tsoecha.co,sokyuut',
            'gender_category' => 'required|in:pria,wanita',
            'category' => 'nullable|string|max:80',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['editingId', 'name', 'description', 'category', 'price', 'stock', 'image', 'existingImage']);
        $this->brand = 'tsoecha.co';
        $this->gender_category = 'pria';
        $this->status = 'active';
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $p = Product::where('seller_id', Auth::id())->findOrFail($id);
        $this->editingId = $p->id;
        $this->name = $p->name;
        $this->description = $p->description ?? '';
        $this->brand = $p->brand;
        $this->gender_category = $p->gender_category;
        $this->category = $p->category ?? '';
        $this->price = (float) $p->price;
        $this->stock = (int) $p->stock;
        $this->status = $p->status;
        $this->existingImage = $p->image;
        $this->image = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();

        $payload = [
            'seller_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'brand' => $data['brand'],
            'gender_category' => $data['gender_category'],
            'category' => $data['category'] ?? null,
            'price' => $data['price'],
            'stock' => $data['stock'],
            'status' => $data['status'],
        ];
        if ($this->image) {
            $payload['image'] = $this->image->store('products', 'public');
        }

        if ($this->editingId) {
            Product::where('seller_id', Auth::id())->findOrFail($this->editingId)->update($payload);
            session()->flash('success', 'Produk diperbarui.');
        } else {
            Product::create($payload);
            session()->flash('success', 'Produk ditambahkan.');
        }
        $this->showForm = false;
        $this->reset(['editingId', 'name', 'description', 'category', 'price', 'stock', 'image', 'existingImage']);
    }

    public function toggleStatus(int $id): void
    {
        $p = Product::where('seller_id', Auth::id())->findOrFail($id);
        $p->status = $p->status === 'active' ? 'inactive' : 'active';
        $p->save();
    }

    public function delete(int $id): void
    {
        $p = Product::where('seller_id', Auth::id())->findOrFail($id);
        if ($p->image) {
            Storage::disk('public')->delete($p->image);
        }
        $p->delete();
        session()->flash('success', 'Produk dihapus.');
    }

    #[Title('Produk Saya - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.seller.manage-products-component', [
            'products' => Product::where('seller_id', Auth::id())->latest()->paginate(10),
        ]);
    }
}
