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
        'regularPrice',
        'discountPrice',
        'bathrooms',
        'bedrooms',
        'furnished',
        'parking',
        'type',
        'offer',
        'imageUrls',
        'userRef',
    ];

    protected $casts = [
        'imageUrls' => 'array',
        'furnished' => 'boolean',
        'parking' => 'boolean',
        'offer' => 'boolean',
    ];
}
