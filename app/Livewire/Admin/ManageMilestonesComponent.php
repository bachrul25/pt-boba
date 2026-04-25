<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageMilestonesComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public string $title = '';

    public ?int $year = null;

    public string $month = '';

    public string $description = '';

    public string $icon = '';

    public int $order_index = 0;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:160',
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'nullable|string|max:30',
            'description' => 'required|string|max:2000',
            'icon' => 'nullable|string|max:60',
            'order_index' => 'integer',
        ];
    }

    public function newItem(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $m = Milestone::findOrFail($id);
        $this->editingId = $m->id;
        $this->title = $m->title;
        $this->year = $m->year;
        $this->month = $m->month ?? '';
        $this->description = $m->description;
        $this->icon = $m->icon ?? '';
        $this->order_index = $m->order_index;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        if ($this->editingId) {
            Milestone::find($this->editingId)?->update($data);
        } else {
            Milestone::create($data);
        }
        session()->flash('msg', 'Milestone disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Milestone::find($id)?->delete();
        session()->flash('msg', 'Milestone dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->year = (int) date('Y');
        $this->month = '';
        $this->description = '';
        $this->icon = '';
        $this->order_index = 0;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Milestones')]
    public function render()
    {
        return view('livewire.admin.manage-milestones-component', [
            'items' => Milestone::orderBy('year')->orderBy('order_index')->get(),
        ]);
    }
}
