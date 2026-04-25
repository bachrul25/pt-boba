<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'country',
        'investment_range',
        'interest_area',
        'message',
        'status',
        'admin_notes',
    ];
}
