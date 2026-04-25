<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Founder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageFoundersComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public string $name = '';

    public string $position = '';

    public string $description = '';

    public string $photo = '';

    public int $order_index = 0;

    public bool $showForm = false;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'position' => 'required|string|max:120',
            'description' => 'required|string|max:2000',
            'photo' => 'nullable|string|max:500',
            'order_index' => 'integer',
        ];
    }

    public function newFounder(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $f = Founder::findOrFail($id);
        $this->editingId = $f->id;
        $this->name = $f->name;
        $this->position = $f->position;
        $this->description = $f->description;
        $this->photo = $f->photo ?? '';
        $this->order_index = $f->order_index;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        if ($this->editingId) {
            Founder::find($this->editingId)?->update($data);
            session()->flash('msg', 'Founder diperbarui.');
        } else {
            Founder::create($data);
            session()->flash('msg', 'Founder ditambahkan.');
        }
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Founder::find($id)?->delete();
        session()->flash('msg', 'Founder dihapus.');
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
        $this->position = '';
        $this->description = '';
        $this->photo = '';
        $this->order_index = 0;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Founders')]
    public function render()
    {
        return view('livewire.admin.manage-founders-component', [
            'founders' => Founder::orderBy('order_index')->get(),
        ]);
    }
}
