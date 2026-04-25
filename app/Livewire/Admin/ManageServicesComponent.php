<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageServicesComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public ?int $brand_id = null;

    public ?int $seller_id = null;

    public string $name = '';

    public string $category = '';

    public string $description = '';

    public string $price = '0';

    public string $unit = 'layanan';

    public bool $is_active = true;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'seller_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:160',
            'category' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ];
    }

    public function newService(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $s = Service::findOrFail($id);
        $this->editingId = $s->id;
        $this->brand_id = $s->brand_id;
        $this->seller_id = $s->seller_id;
        $this->name = $s->name;
        $this->category = $s->category ?? '';
        $this->description = $s->description ?? '';
        $this->price = (string) $s->price;
        $this->unit = $s->unit;
        $this->is_active = (bool) $s->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        if ($this->editingId) {
            Service::find($this->editingId)?->update($data);
        } else {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(4);
            Service::create($data);
        }
        session()->flash('msg', 'Layanan disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Service::find($id)?->delete();
        session()->flash('msg', 'Layanan dihapus.');
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
        $this->unit = 'layanan';
        $this->is_active = true;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Services - Ponpin')]
    public function render()
    {
        return view('livewire.admin.manage-services-component', [
            'services' => Service::with(['brand', 'seller'])->latest()->get(),
            'brands' => Brand::where('type', 'service')->get(),
            'sellers' => User::where('role', 'seller')->get(),
        ]);
    }
}
