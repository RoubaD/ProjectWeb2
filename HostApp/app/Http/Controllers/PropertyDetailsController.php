<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Reservation; // Import the Reservation model

class PropertyDetailsController extends Controller
{
    /**
     * Show the details of a specific property.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Fetch the destination details by ID
        $destination = Destination::findOrFail($id);

        // Pass the destination details to the view
        return view('destinations.show', compact('destination'));
    }



    public function getReservedDates($id)
    {
        // Fetch reserved dates for the specified property
        $reservedDates = Reservation::where('destination_id', $id)->pluck('reserved_date');

        // Return the dates as a JSON response
        return response()->json($reservedDates);
    }
}
