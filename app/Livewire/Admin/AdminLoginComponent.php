<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdminLoginComponent extends Component
{
    public string $email = '';

    public string $password = '';

    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (! Auth::attempt($data)) {
            $this->addError('email', 'Email atau password salah.');

            return;
        }

        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            $this->addError('email', 'Akun ini bukan admin.');

            return;
        }

        request()->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    #[Title('Admin Login - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.admin-login-component');
    }
}
