<?php

namespace App\Livewire\Buyer;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceListComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $service_type = '';

    #[Url]
    public string $category = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    #[Title('Layanan tos2bro - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $services = Service::with('seller')
            ->where('status', 'active')
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->service_type !== '', fn ($q) => $q->where('service_type', $this->service_type))
            ->when($this->category !== '', fn ($q) => $q->where('category', 'like', "%{$this->category}%"))
            ->latest()
            ->paginate(9);

        return view('livewire.buyer.service-list-component', compact('services'));
    }
}
