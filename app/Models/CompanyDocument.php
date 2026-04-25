<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'file_url',
        'year',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}
