<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePageComponent extends Component
{
    #[Title('Home - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.home-page-component');
    }
}
