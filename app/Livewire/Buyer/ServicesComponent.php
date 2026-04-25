<?php

namespace App\Livewire\Buyer;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ServicesComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'buyer';

    public ?int $selected = null;

    public string $contact_name = '';

    public string $contact_phone = '';

    public string $address = '';

    public ?string $scheduled_at = null;

    public string $notes = '';

    public function mount(): void
    {
        $u = auth()->user();
        $this->contact_name = $u->name;
        $this->contact_phone = $u->phone ?? '';
        $this->address = $u->address ?? '';
    }

    public function selectService(int $id): void
    {
        $this->selected = $id;
    }

    public function cancel(): void
    {
        $this->selected = null;
    }

    public function placeRequest()
    {
        $data = $this->validate([
            'contact_name' => 'required|string|max:120',
            'contact_phone' => 'required|string|max:30',
            'address' => 'required|string|max:500',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $service = Service::find($this->selected);
        if (! $service) {
            $this->addError('selected', 'Layanan tidak ditemukan.');

            return;
        }

        ServiceRequest::create([
            'request_number' => 'PONPIN-'.strtoupper(Str::random(8)),
            'buyer_id' => auth()->id(),
            'service_id' => $service->id,
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'address' => $data['address'],
            'scheduled_at' => $data['scheduled_at'] ?? null,
            'notes' => $data['notes'] ?? null,
            'estimated_price' => $service->price,
            'status' => 'pending',
        ]);

        session()->flash('msg', "Pesanan layanan {$service->name} berhasil dikirim.");
        $this->selected = null;
        $this->notes = '';
        $this->scheduled_at = null;

        return $this->redirect('/buyer/service-requests', navigate: false);
    }

    #[Layout('layouts.dashboard')]
    #[Title('Pesan Layanan Ponpin')]
    public function render()
    {
        return view('livewire.buyer.services-component', [
            'services' => Service::with('brand')->where('is_active', true)->get(),
            'selectedService' => $this->selected ? Service::find($this->selected) : null,
        ]);
    }
}
