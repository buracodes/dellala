<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'regular_price',
        'discount_price',
        'bathrooms',
        'bedrooms',
        'furnished',
        'parking',
        'type',
        'offer',
        'image_urls',
        'user_ref',
    ];

    protected $casts = [
        'image_urls' => 'array',
        'furnished' => 'boolean',
        'parking' => 'boolean',
        'offer' => 'boolean',
    ];
}
