<?php

namespace App\Livewire;

use App\Models\CompanyDocument;
use App\Models\ImpactMetric;
use App\Models\InvestorInquiry;
use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class InvestorRelationsComponent extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $company = '';

    public string $country = '';

    public string $investment_range = '';

    public string $interest_area = '';

    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'company' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:80',
            'investment_range' => 'nullable|string|max:80',
            'interest_area' => 'nullable|string|max:120',
            'message' => 'required|string|max:3000',
        ]);

        InvestorInquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'company' => $this->company ?: null,
            'country' => $this->country ?: null,
            'investment_range' => $this->investment_range ?: null,
            'interest_area' => $this->interest_area ?: null,
            'message' => $this->message,
            'status' => 'new',
        ]);

        $this->reset(['name', 'email', 'phone', 'company', 'country', 'investment_range', 'interest_area', 'message']);
        $this->submitted = true;
    }

    #[Layout('layouts.app')]
    #[Title('Investor Relations - PT BOBA')]
    public function render()
    {
        return view('livewire.investor-relations-component', [
            'metrics' => ImpactMetric::orderBy('order_index')->get(),
            'milestones' => Milestone::orderBy('year')->orderBy('order_index')->get(),
            'documents' => CompanyDocument::where('is_public', true)->latest('year')->get(),
        ]);
    }
}
