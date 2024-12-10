<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // List of fields that can be mass-assigned
    protected $fillable = [
        'name',
        'landmark',
        'price',
        'property_type',
        'amenities',
        'guest_capacity',
        'availability',
        'image',
        'latitude',
        'longitude',
    ];

    // Casting JSON fields to arrays automatically
    protected $casts = [
        'amenities' => 'array',
        'availability' => 'array',
    ];

    // Relationship with reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
