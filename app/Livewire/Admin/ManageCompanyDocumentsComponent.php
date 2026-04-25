<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\AuthorizesRole;
use App\Models\CompanyDocument;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageCompanyDocumentsComponent extends Component
{
    use AuthorizesRole;

    protected string $requiredRole = 'admin';

    public ?int $editingId = null;

    public string $title = '';

    public string $category = '';

    public string $description = '';

    public string $file_url = '';

    public ?int $year = null;

    public bool $is_public = true;

    public bool $showForm = false;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:160',
            'category' => 'nullable|string|max:80',
            'description' => 'nullable|string|max:2000',
            'file_url' => 'nullable|string|max:500',
            'year' => 'nullable|integer|min:2000|max:2100',
            'is_public' => 'boolean',
        ];
    }

    public function newDoc(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $d = CompanyDocument::findOrFail($id);
        $this->editingId = $d->id;
        $this->title = $d->title;
        $this->category = $d->category ?? '';
        $this->description = $d->description ?? '';
        $this->file_url = $d->file_url ?? '';
        $this->year = $d->year;
        $this->is_public = (bool) $d->is_public;
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        if ($this->editingId) {
            CompanyDocument::find($this->editingId)?->update($data);
        } else {
            CompanyDocument::create($data);
        }
        session()->flash('msg', 'Dokumen disimpan.');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        CompanyDocument::find($id)?->delete();
        session()->flash('msg', 'Dokumen dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->category = '';
        $this->description = '';
        $this->file_url = '';
        $this->year = (int) date('Y');
        $this->is_public = true;
    }

    #[Layout('layouts.dashboard')]
    #[Title('Company Documents')]
    public function render()
    {
        return view('livewire.admin.manage-company-documents-component', [
            'documents' => CompanyDocument::latest('year')->get(),
        ]);
    }
}
