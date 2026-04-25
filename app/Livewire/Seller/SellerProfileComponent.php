<?php

namespace App\Livewire\Seller;

use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class SellerProfileComponent extends Component
{
    public string $shop_name = '';

    public string $shop_description = '';

    public string $shop_address = '';

    public ?SellerProfile $profile = null;

    public function mount(): void
    {
        $user = Auth::user();
        $this->profile = $user->sellerProfile ?? SellerProfile::make(['user_id' => $user->id, 'status' => 'pending']);
        $this->shop_name = $this->profile->shop_name ?? '';
        $this->shop_description = $this->profile->shop_description ?? '';
        $this->shop_address = $this->profile->shop_address ?? '';
    }

    public function save(): void
    {
        $data = $this->validate([
            'shop_name' => 'required|string|min:2|max:120',
            'shop_description' => 'nullable|string|max:2000',
            'shop_address' => 'nullable|string|max:500',
        ]);

        $profile = Auth::user()->sellerProfile ?? new SellerProfile(['user_id' => Auth::id(), 'status' => 'pending']);
        $profile->fill($data);
        $profile->user_id = Auth::id();
        $profile->status = $profile->status ?? 'pending';
        $profile->is_completed = filled($data['shop_name']) && filled($data['shop_description']) && filled($data['shop_address']);
        $profile->save();

        $this->profile = $profile->fresh();
        session()->flash('success', 'Profil toko disimpan.');
    }

    #[Title('Profil Toko - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.seller.seller-profile-component');
    }
}
