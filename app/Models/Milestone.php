<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'title',
        'year',
        'month',
        'description',
        'icon',
        'order_index',
    ];
}
