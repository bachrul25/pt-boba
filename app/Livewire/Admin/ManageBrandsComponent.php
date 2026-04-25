<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageBrandsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public string $name = '';

    public string $slug = '';

    public string $type = 'fashion';

    public string $category = '';

    public string $description = '';

    public bool $is_active = true;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120',
            'type' => 'required|in:fashion,service',
            'category' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:2000',
            'is_active' => 'boolean',
        ];
    }

    public function newBrand(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $b = Brand::findOrFail($id);
        $this->editingId = $b->id;
        $this->name = $b->name;
        $this->slug = $b->slug;
        $this->type = $b->type;
        $this->category = $b->category ?? '';
        $this->description = $b->description ?? '';
        $this->is_active = (bool) $b->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($this->editingId) {
            Brand::find($this->editingId)?->update($data);
        } else {
            Brand::create($data);
        }
        session()->flash('msg', 'Brand disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Brand::find($id)?->delete();
        session()->flash('msg', 'Brand dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->slug = '';
        $this->type = 'fashion';
        $this->category = '';
        $this->description = '';
        $this->is_active = true;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Brands')]
    public function render()
    {
        return view('livewire.admin.manage-brands-component', [
            'brands' => Brand::orderBy('id')->get(),
        ]);
    }
}
