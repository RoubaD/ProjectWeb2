<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'reserved_date'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
