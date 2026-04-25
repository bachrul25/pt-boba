<?php

namespace App\Livewire\Buyer;

use App\Models\Payment;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ServiceBookingComponent extends Component
{
    public Service $service;

    public string $requirement = '';

    public string $payment_method = 'Transfer Bank';

    public string $payment_outcome = 'success';

    public ?int $lastBookingId = null;

    public ?string $lastPaymentStatus = null;

    public function mount(int $id): void
    {
        $this->service = Service::with('seller')->where('status', 'active')->findOrFail($id);
    }

    public function book(): void
    {
        $data = $this->validate([
            'requirement' => 'required|string|max:2000',
            'payment_method' => 'required|in:Transfer Bank,E-Wallet,COD',
            'payment_outcome' => 'required|in:success,failed',
        ]);

        DB::transaction(function () use ($data) {
            $booking = ServiceBooking::create([
                'buyer_id' => Auth::id(),
                'seller_id' => $this->service->seller_id,
                'service_id' => $this->service->id,
                'requirement' => $data['requirement'],
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_outcome'] === 'success' ? 'success' : 'failed',
                'booking_status' => $data['payment_outcome'] === 'success' ? 'processing' : 'pending',
            ]);

            Payment::create([
                'user_id' => Auth::id(),
                'service_booking_id' => $booking->id,
                'payment_method' => $data['payment_method'],
                'amount' => $this->service->price,
                'status' => $data['payment_outcome'] === 'success' ? 'success' : 'failed',
            ]);

            $this->lastBookingId = $booking->id;
            $this->lastPaymentStatus = $data['payment_outcome'];
        });

        if ($this->lastPaymentStatus === 'success') {
            session()->flash('success', 'Booking sukses! Layanan diproses.');
        } else {
            session()->flash('error', 'Pembayaran gagal. Silakan retry.');
        }
    }

    public function retryPayment(): void
    {
        if (! $this->lastBookingId) {
            return;
        }

        $b = ServiceBooking::findOrFail($this->lastBookingId);
        $b->payment_status = 'success';
        $b->booking_status = 'processing';
        $b->save();
        Payment::where('service_booking_id', $b->id)->update(['status' => 'success']);

        $this->lastPaymentStatus = 'success';
        session()->flash('success', 'Pembayaran berhasil setelah retry!');
    }

    #[Title('Booking Layanan - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.buyer.service-booking-component');
    }
}
