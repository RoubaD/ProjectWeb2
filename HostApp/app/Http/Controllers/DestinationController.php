<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $destinations = Destination::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('landmark', 'like', "%$search%")
                ->orWhere('property_type', 'like', "%$search%");
        })->take(6)->get();

        // Ensure amenities are always decoded
        foreach ($destinations as $destination) {
            $destination->amenities = is_array($destination->amenities)
                ? $destination->amenities
                : json_decode($destination->amenities, true);
        }

        return view('destinations', compact('destinations', 'search'));
    }


    

    public function getReservedDates($id)
    {
        $destination = Destination::findOrFail($id);
        $reservedDates = $destination->reservations->pluck('reserved_date');
        return response()->json($reservedDates);
    }

    public function search(Request $request)
    {
        // Get the search query
        $query = $request->input('query');

        // Search for destinations by name, property name, or landmark
        $destinations = Destination::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('landmark', 'LIKE', '%' . $query . '%')
            ->orWhere('property_type', 'LIKE', '%' . $query . '%')
            ->get();

        // Decode the amenities JSON if necessary
        foreach ($destinations as $destination) {
            $destination->amenities = json_decode($destination->amenities, true);
        }

        // Pass the search results to the view
        return view('destinations', compact('destinations'));
    }

    public function mapSearch()
    {
        $destinations = Destination::all([
            'name', 
            'landmark', 
            'latitude', 
            'longitude', 
            'property_type', 
            'price'
        ]);

        return view('destinations.map_search', compact('destinations'));
    }

    





}
