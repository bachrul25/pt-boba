<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginComponent extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirectToDashboard();
        }
    }

    public function login()
    {
        $data = $this->validate();

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember)) {
            $this->addError('email', 'Email atau password salah.');

            return;
        }

        request()->session()->regenerate();

        return $this->redirectToDashboard();
    }

    protected function redirectToDashboard()
    {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            default => redirect()->route('buyer.dashboard'),
        };
    }

    #[Title('Login - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.auth.login-component');
    }
}
