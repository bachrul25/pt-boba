<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class RegisterComponent extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $password = '';

    public string $password_confirmation = '';

    protected array $rules = [
        'name' => 'required|string|min:2|max:120',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|string|max:40',
        'address' => 'nullable|string|max:500',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
    {
        $data = $this->validate();
        $data['role'] = 'buyer';

        User::create($data);

        session()->flash('success', 'Registrasi buyer berhasil. Silakan login.');

        return redirect()->route('login');
    }

    #[Title('Register Buyer - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.auth.register-component');
    }
}
