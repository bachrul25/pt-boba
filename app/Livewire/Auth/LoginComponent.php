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

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (! Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'Email atau password salah.');

            return;
        }

        $user = Auth::user();
        if (! $user->is_active) {
            Auth::logout();
            $this->addError('email', 'Akun Anda nonaktif. Hubungi admin PT BOBA.');

            return;
        }

        session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin' => $this->redirect('/admin', navigate: false),
            'seller' => $this->redirect('/seller', navigate: false),
            default => $this->redirect('/buyer', navigate: false),
        };
    }

    #[Layout('layouts.app')]
    #[Title('Login - PT BOBA')]
    public function render()
    {
        return view('livewire.auth.login-component');
    }
}
