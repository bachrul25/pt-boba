<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class RoleSelectComponent extends Component
{
    #[Layout('layouts.app')]
    #[Title('Pilih Peran - PT BOBA')]
    public function render()
    {
        return view('livewire.auth.role-select-component');
    }
}
