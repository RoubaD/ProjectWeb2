<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'reserved_date' => 'required|date|after:today',
        ]);

        $destination = Destination::findOrFail($id);

        if ($destination->reservations()->where('reserved_date', $request->reserved_date)->exists()) {
            return back()->with('error', 'This date is already reserved.');
        }

        $destination->reservations()->create([
            'reserved_date' => $request->reserved_date,
        ]);

        return back()->with('success', 'Date reserved successfully!');
    }
}
