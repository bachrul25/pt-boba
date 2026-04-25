<?php

namespace App\Livewire\Concerns;

trait AuthorizesRole
{
    public function bootAuthorizesRole(): void
    {
        $required = $this->requiredRole ?? null;
        if ($required) {
            abort_unless(auth()->user()?->role === $required, 403, 'Akses ditolak.');
        }
    }
}
