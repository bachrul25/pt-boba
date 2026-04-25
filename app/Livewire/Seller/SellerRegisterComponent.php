<?php

namespace App\Livewire\Seller;

use App\Models\SellerProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class SellerRegisterComponent extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $shop_name = '';

    public string $shop_description = '';

    public string $shop_address = '';

    protected array $rules = [
        'name' => 'required|string|min:2|max:120',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|string|max:40',
        'address' => 'nullable|string|max:500',
        'password' => 'required|min:6|confirmed',
        'shop_name' => 'required|string|min:2|max:120',
        'shop_description' => 'nullable|string|max:1000',
        'shop_address' => 'nullable|string|max:500',
    ];

    public function register()
    {
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'password' => $data['password'],
                'role' => 'seller',
            ]);

            $isCompleted = filled($data['shop_name']) && filled($data['shop_description'] ?? null) && filled($data['shop_address'] ?? null);

            SellerProfile::create([
                'user_id' => $user->id,
                'shop_name' => $data['shop_name'],
                'shop_description' => $data['shop_description'] ?? null,
                'shop_address' => $data['shop_address'] ?? null,
                'status' => 'pending',
                'is_completed' => $isCompleted,
            ]);
        });

        session()->flash('success', 'Registrasi seller berhasil! Menunggu approval admin. Silakan login.');

        return redirect()->route('login');
    }

    #[Title('Register Seller - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.seller.seller-register-component');
    }
}
