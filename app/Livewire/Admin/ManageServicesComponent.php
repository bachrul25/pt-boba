<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageServicesComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $service_type = '';

    #[Url]
    public string $status = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $s = Service::findOrFail($id);
        $s->status = $s->status === 'active' ? 'inactive' : 'active';
        $s->save();
        session()->flash('success', 'Status layanan diperbarui.');
    }

    public function destroy(int $id): void
    {
        Service::findOrFail($id)->delete();
        session()->flash('success', 'Layanan dihapus.');
    }

    #[Title('Kelola Layanan - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $query = Service::with('seller')
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->service_type !== '', fn ($q) => $q->where('service_type', $this->service_type))
            ->when($this->status !== '', fn ($q) => $q->where('status', $this->status));

        return view('livewire.admin.manage-services-component', [
            'services' => $query->latest()->paginate(10),
        ]);
    }
}
