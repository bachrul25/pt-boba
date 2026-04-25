<?php

namespace App\Livewire\Seller;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageServicesComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $description = '';

    public string $service_type = 'pengambilan_sampah';

    public string $category = '';

    public $price = 0;

    public string $status = 'active';

    public $image;

    public ?string $existingImage = null;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:3000',
            'service_type' => 'required|in:pengambilan_sampah,pengelolaan_sampah,pengolahan_sampah_organik,bahan_bakar_kendaraan',
            'category' => 'nullable|string|max:80',
            'price' => 'required|numeric|min:0',
            'status' => 'in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['editingId', 'name', 'description', 'category', 'price', 'image', 'existingImage']);
        $this->service_type = 'pengambilan_sampah';
        $this->status = 'active';
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $s = Service::where('seller_id', Auth::id())->findOrFail($id);
        $this->editingId = $s->id;
        $this->name = $s->name;
        $this->description = $s->description ?? '';
        $this->service_type = $s->service_type;
        $this->category = $s->category ?? '';
        $this->price = (float) $s->price;
        $this->status = $s->status;
        $this->existingImage = $s->image;
        $this->image = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();

        $payload = [
            'seller_id' => Auth::id(),
            'brand' => 'tos2bro',
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'service_type' => $data['service_type'],
            'category' => $data['category'] ?? null,
            'price' => $data['price'],
            'status' => $data['status'],
        ];
        if ($this->image) {
            $payload['image'] = $this->image->store('services', 'public');
        }

        if ($this->editingId) {
            Service::where('seller_id', Auth::id())->findOrFail($this->editingId)->update($payload);
            session()->flash('success', 'Layanan diperbarui.');
        } else {
            Service::create($payload);
            session()->flash('success', 'Layanan ditambahkan.');
        }
        $this->showForm = false;
        $this->reset(['editingId', 'name', 'description', 'category', 'price', 'image', 'existingImage']);
    }

    public function toggleStatus(int $id): void
    {
        $s = Service::where('seller_id', Auth::id())->findOrFail($id);
        $s->status = $s->status === 'active' ? 'inactive' : 'active';
        $s->save();
    }

    public function delete(int $id): void
    {
        $s = Service::where('seller_id', Auth::id())->findOrFail($id);
        if ($s->image) {
            Storage::disk('public')->delete($s->image);
        }
        $s->delete();
        session()->flash('success', 'Layanan dihapus.');
    }

    #[Title('Layanan Saya - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.seller.manage-services-component', [
            'services' => Service::where('seller_id', Auth::id())->latest()->paginate(10),
        ]);
    }
}
