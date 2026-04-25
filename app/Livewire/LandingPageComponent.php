<?php

namespace App\Livewire;

use App\Models\CompanyStructure;
use App\Models\Product;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class LandingPageComponent extends Component
{
    public ?string $brandFilter = null;

    public function setBrand(?string $brand = null): void
    {
        $this->brandFilter = $brand;
    }

    #[Title('PT Bikin Orang Bahagia (PT BOBA)')]
    #[Layout('layouts.app')]
    public function render()
    {
        $productsQuery = Product::query()->where('status', 'active');
        if ($this->brandFilter) {
            $productsQuery->where('brand', $this->brandFilter);
        }
        $products = $productsQuery->latest()->take(6)->get();

        $services = Service::where('status', 'active')->latest()->take(4)->get();
        $founders = CompanyStructure::where('status', 'active')->orderBy('sort_order')->get();

        return view('livewire.landing-page-component', [
            'products' => $products,
            'services' => $services,
            'founders' => $founders,
        ]);
    }
}
