<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function getUserReservations(DestinationController $destinationController)
{
    $userId = Auth::id();

    $reservations = Reservation::where('client_id', $userId)->get();

    foreach ($reservations as $reservation) {
        $reservation->destinationDetails = $destinationController->getDestinationById($reservation->destination_id);
    }

    return view('reservations.index', compact('reservations'));
}

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
