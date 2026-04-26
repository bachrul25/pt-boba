<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    protected $fillable = [
        'request_number',
        'buyer_id',
        'service_id',
        'contact_name',
        'contact_phone',
        'address',
        'scheduled_at',
        'notes',
        'estimated_price',
        'status',
        'payment_provider',
        'payment_external_id',
        'payment_invoice_id',
        'payment_status',
        'payment_url',
        'paid_at',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
        'estimated_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
