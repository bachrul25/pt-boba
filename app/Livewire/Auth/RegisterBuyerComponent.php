<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class RegisterBuyerComponent extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'password' => $data['password'],
            'role' => 'buyer',
            'is_active' => true,
        ]);

        Auth::login($user);
        session()->regenerate();

        return $this->redirect('/buyer', navigate: false);
    }

    #[Layout('layouts.app')]
    #[Title('Daftar Buyer - PT BOBA')]
    public function render()
    {
        return view('livewire.auth.register-buyer-component');
    }
}
