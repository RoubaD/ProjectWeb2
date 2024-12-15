<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Specify the table associated with the model (optional if using the default table name 'reservations')
    protected $table = 'reservations';

    // Define the fillable fields for mass-assignment protection
    protected $fillable = [
        'destination_id', 
        'start_date', 
        'end_date',  
        'client_id', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
