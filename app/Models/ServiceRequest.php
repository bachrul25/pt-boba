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
    ];

    protected $casts = [
        'scheduled_at' => 'date',
        'estimated_price' => 'decimal:2',
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
