<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Payment;
use App\Models\ServiceBooking;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class ViewReportsComponent extends Component
{
    #[Url]
    public string $start_date = '';

    #[Url]
    public string $end_date = '';

    public function resetFilter(): void
    {
        $this->reset(['start_date', 'end_date']);
    }

    #[Title('Laporan - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $applyRange = function ($q, $col = 'created_at') {
            if ($this->start_date) {
                $q->whereDate($col, '>=', $this->start_date);
            }
            if ($this->end_date) {
                $q->whereDate($col, '<=', $this->end_date);
            }

            return $q;
        };

        $orders = Order::with('buyer')->tap(fn ($q) => $applyRange($q))->latest()->take(20)->get();
        $bookings = ServiceBooking::with(['buyer', 'service'])->tap(fn ($q) => $applyRange($q))->latest()->take(20)->get();
        $payments = Payment::with('user')->tap(fn ($q) => $applyRange($q))->latest()->take(20)->get();

        $totalRevenue = (float) Payment::where('status', 'success')
            ->tap(fn ($q) => $applyRange($q))
            ->sum('amount');

        return view('livewire.admin.view-reports-component', compact('orders', 'bookings', 'payments', 'totalRevenue'));
    }
}
