<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\InvestorInquiry;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageInvestorInquiriesComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $viewingId = null;

    public string $admin_notes = '';

    public string $status = 'new';

    public function open(int $id): void
    {
        $i = InvestorInquiry::findOrFail($id);
        $this->viewingId = $i->id;
        $this->admin_notes = $i->admin_notes ?? '';
        $this->status = $i->status;
    }

    public function close(): void
    {
        $this->viewingId = null;
    }

    public function save(): void
    {
        $this->validate([
            'admin_notes' => 'nullable|string|max:3000',
            'status' => 'required|in:new,contacted,in_review,closed',
        ]);
        InvestorInquiry::find($this->viewingId)?->update([
            'admin_notes' => $this->admin_notes,
            'status' => $this->status,
        ]);
        session()->flash('msg', 'Inquiry diperbarui.');
        $this->viewingId = null;
    }

    public function delete(int $id): void
    {
        InvestorInquiry::find($id)?->delete();
        session()->flash('msg', 'Inquiry dihapus.');
    }

    #[Layout('layouts.dashboard')]
    #[Title('Investor Inquiries')]
    public function render()
    {
        return view('livewire.admin.manage-investor-inquiries-component', [
            'inquiries' => InvestorInquiry::latest()->get(),
            'current' => $this->viewingId ? InvestorInquiry::find($this->viewingId) : null,
        ]);
    }
}
