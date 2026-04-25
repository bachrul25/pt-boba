<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Founder;
use App\Models\ImpactMetric;
use App\Models\InvestorInquiry;
use App\Models\Milestone;
use App\Models\Product;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class LandingPageComponent extends Component
{
    public string $contactName = '';

    public string $contactEmail = '';

    public string $contactMessage = '';

    public bool $contactSent = false;

    public function submitContact(): void
    {
        $this->validate([
            'contactName' => 'required|string|max:120',
            'contactEmail' => 'required|email',
            'contactMessage' => 'required|string|max:2000',
        ]);

        // Persist as InvestorInquiry with category "Contact" so admins can read it.
        InvestorInquiry::create([
            'name' => $this->contactName,
            'email' => $this->contactEmail,
            'interest_area' => 'Contact / General',
            'message' => $this->contactMessage,
            'status' => 'new',
        ]);

        $this->reset(['contactName', 'contactEmail', 'contactMessage']);
        $this->contactSent = true;
    }

    #[Layout('layouts.app')]
    #[Title('PT Bikin Orang Bahagia (PT BOBA) - Industri Tekstil, Fashion, Green Technology')]
    public function render()
    {
        return view('livewire.landing-page-component', [
            'founders' => Founder::orderBy('order_index')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('id')->get(),
            'fashionProducts' => Product::with('brand')->where('is_active', true)
                ->whereHas('brand', fn ($q) => $q->where('type', 'fashion'))
                ->latest()->take(6)->get(),
            'services' => Service::with('brand')->where('is_active', true)->take(4)->get(),
            'metrics' => ImpactMetric::orderBy('order_index')->get(),
            'milestones' => Milestone::orderBy('year')->orderBy('order_index')->get(),
        ]);
    }
}
