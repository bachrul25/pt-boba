<?php

namespace App\Livewire\Buyer;

use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ServiceTrackingComponent extends Component
{
    public function complete(int $id): void
    {
        $b = ServiceBooking::where('buyer_id', Auth::id())->findOrFail($id);
        $b->booking_status = 'completed';
        $b->save();
        session()->flash('success', 'Layanan ditandai selesai.');
    }

    public function cancel(int $id): void
    {
        $b = ServiceBooking::where('buyer_id', Auth::id())->findOrFail($id);
        if (in_array($b->booking_status, ['pending', 'processing'])) {
            $b->booking_status = 'cancelled';
            $b->save();
            session()->flash('success', 'Booking dibatalkan.');
        }
    }

    #[Title('Tracking Layanan - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $bookings = ServiceBooking::with(['service', 'seller'])
            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.buyer.service-tracking-component', compact('bookings'));
    }
}
