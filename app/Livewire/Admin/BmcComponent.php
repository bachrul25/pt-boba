<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BmcComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    #[Layout('layouts.dashboard')]
    #[Title('Business Model Canvas - PT BOBA')]
    public function render()
    {
        return view('livewire.admin.bmc-component');
    }
}
