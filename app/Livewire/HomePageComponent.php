<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePageComponent extends Component
{
    #[Layout('layouts.app')]
    #[Title('Home - PT BOBA Marketplace')]
    public function render()
    {
        return view('livewire.home-page-component', [
            'brands' => Brand::where('is_active', true)->get(),
            'products' => Product::with('brand')->where('is_active', true)->latest()->take(8)->get(),
            'services' => Service::with('brand')->where('is_active', true)->take(4)->get(),
        ]);
    }
}
