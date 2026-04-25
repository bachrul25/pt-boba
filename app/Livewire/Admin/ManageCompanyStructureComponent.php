<?php

namespace App\Livewire\Admin;

use App\Models\CompanyStructure;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageCompanyStructureComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $position = '';

    public string $description = '';

    public int $sort_order = 0;

    public string $status = 'active';

    public $photo; // uploaded file

    public ?string $existingPhoto = null;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'position' => 'required|string|max:120',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'integer|min:0',
            'status' => 'in:active,inactive',
            'photo' => $this->editingId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['editingId', 'name', 'position', 'description', 'sort_order', 'status', 'photo', 'existingPhoto']);
        $this->status = 'active';
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $c = CompanyStructure::findOrFail($id);
        $this->editingId = $c->id;
        $this->name = $c->name;
        $this->position = $c->position;
        $this->description = $c->description ?? '';
        $this->sort_order = (int) $c->sort_order;
        $this->status = $c->status;
        $this->existingPhoto = $c->photo;
        $this->photo = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description ?: null,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('founders', 'public');
        }

        if ($this->editingId) {
            CompanyStructure::find($this->editingId)->update($data);
            session()->flash('success', 'Data pendiri berhasil diperbarui.');
        } else {
            CompanyStructure::create($data);
            session()->flash('success', 'Data pendiri berhasil ditambahkan.');
        }

        $this->showForm = false;
        $this->reset(['editingId', 'name', 'position', 'description', 'sort_order', 'status', 'photo', 'existingPhoto']);
    }

    public function toggleStatus(int $id): void
    {
        $c = CompanyStructure::findOrFail($id);
        $c->status = $c->status === 'active' ? 'inactive' : 'active';
        $c->save();
        session()->flash('success', 'Status berhasil diubah.');
    }

    public function delete(int $id): void
    {
        $c = CompanyStructure::findOrFail($id);
        if ($c->photo) {
            Storage::disk('public')->delete($c->photo);
        }
        $c->delete();
        session()->flash('success', 'Data pendiri dihapus.');
    }

    #[Title('Kelola Struktur - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.manage-company-structure-component', [
            'items' => CompanyStructure::orderBy('sort_order')->paginate(10),
        ]);
    }
}
