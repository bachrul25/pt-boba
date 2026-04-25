<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class RegisterSellerComponent extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $store_name = '';

    public string $address = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:30',
            'store_name' => 'required|string|max:120',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'store_name' => $data['store_name'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role' => 'seller',
            'is_active' => true,
        ]);

        Auth::login($user);
        session()->regenerate();

        return $this->redirect('/seller', navigate: false);
    }

    #[Layout('layouts.app')]
    #[Title('Daftar Seller - PT BOBA')]
    public function render()
    {
        return view('livewire.auth.register-seller-component');
    }
}
