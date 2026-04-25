<?php

namespace App\Livewire\Seller;

use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
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

    #[Title('Laporan Seller - PT BOBA')]
    #[Layout('layouts.app')]
    public function render()
    {
        $userId = Auth::id();

        $applyRange = function ($q, $col = 'created_at') {
            if ($this->start_date) {
                $q->whereDate($col, '>=', $this->start_date);
            }
            if ($this->end_date) {
                $q->whereDate($col, '<=', $this->end_date);
            }

            return $q;
        };

        $orderItems = OrderItem::with(['order.buyer', 'product'])
            ->where('seller_id', $userId)
            ->tap(fn ($q) => $applyRange($q))
            ->latest()
            ->take(50)
            ->get();

        $bookings = ServiceBooking::with(['buyer', 'service'])
            ->where('seller_id', $userId)
            ->tap(fn ($q) => $applyRange($q))
            ->latest()
            ->take(50)
            ->get();

        $payments = Payment::whereIn('id', function ($q) use ($userId, $applyRange) {
            $q->select('payments.id')
                ->from('payments')
                ->leftJoin('order_items', 'order_items.order_id', '=', 'payments.order_id')
                ->leftJoin('service_bookings', 'service_bookings.id', '=', 'payments.service_booking_id')
                ->where(function ($qq) use ($userId) {
                    $qq->where('order_items.seller_id', $userId)
                        ->orWhere('service_bookings.seller_id', $userId);
                });
            $applyRange($q, 'payments.created_at');
        })
            ->with('user')
            ->latest()
            ->take(50)
            ->get();

        $productRevenue = (float) OrderItem::where('seller_id', $userId)
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'success'))
            ->tap(fn ($q) => $applyRange($q))
            ->sum('subtotal');

        $serviceRevenue = (float) ServiceBooking::where('service_bookings.seller_id', $userId)
            ->where('service_bookings.payment_status', 'success')
            ->join('services', 'services.id', '=', 'service_bookings.service_id')
            ->tap(fn ($q) => $applyRange($q, 'service_bookings.created_at'))
            ->sum('services.price');

        $totalRevenue = $productRevenue + $serviceRevenue;

        return view('livewire.seller.view-reports-component', compact('orderItems', 'bookings', 'payments', 'totalRevenue', 'productRevenue', 'serviceRevenue'));
    }
}
