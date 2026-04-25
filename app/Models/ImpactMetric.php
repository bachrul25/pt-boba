<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactMetric extends Model
{
    protected $fillable = [
        'name',
        'value',
        'unit',
        'category',
        'icon',
        'description',
        'order_index',
    ];
}
