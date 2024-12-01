<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'landmark',
        'price',
        'property_type',
        'amenities',
        'guest_capacity',
    ];

    protected $casts = [
        'amenities' => 'array',
        'availability' => 'array', // If availability is also stored as JSON
    ];
    

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
