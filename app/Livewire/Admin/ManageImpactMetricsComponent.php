<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\ImpactMetric;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageImpactMetricsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public string $name = '';

    public string $value = '';

    public string $unit = '';

    public string $category = '';

    public string $icon = '';

    public string $description = '';

    public int $order_index = 0;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'value' => 'required|string|max:60',
            'unit' => 'nullable|string|max:60',
            'category' => 'nullable|string|max:60',
            'icon' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:1000',
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
        $m = ImpactMetric::findOrFail($id);
        $this->editingId = $m->id;
        foreach (['name', 'value', 'unit', 'category', 'icon', 'description', 'order_index'] as $f) {
            $this->$f = $m->$f ?? ($f === 'order_index' ? 0 : '');
        }
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        if ($this->editingId) {
            ImpactMetric::find($this->editingId)?->update($data);
        } else {
            ImpactMetric::create($data);
        }
        session()->flash('msg', 'Impact metric disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        ImpactMetric::find($id)?->delete();
        session()->flash('msg', 'Impact metric dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->name = $this->value = $this->unit = $this->category = $this->icon = $this->description = '';
        $this->order_index = 0;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Manage Impact Metrics')]
    public function render()
    {
        return view('livewire.admin.manage-impact-metrics-component', [
            'items' => ImpactMetric::orderBy('order_index')->get(),
        ]);
    }
}
