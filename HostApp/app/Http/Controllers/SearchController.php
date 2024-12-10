<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class SearchController extends Controller
{
    public function detailedSearch(Request $request)
    {
        $query = Destination::query();

        // Filter by price range
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        // Filter by property type
        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        // Filter by amenities
        if ($request->filled('amenities')) {
            foreach ($request->amenities as $amenity) {
                $query->whereJsonContains('amenities', $amenity);
            }
        }

        // Filter by guest capacity
        if ($request->filled('guest_capacity')) {
            $query->where('guest_capacity', '>=', $request->guest_capacity);
        }

        // Retrieve results and respond with JSON for AJAX
        $destinations = $query->get();

        if ($request->ajax()) {
            return response()->json(['destinations' => $destinations]);
        }

        return view('detailedSearch', compact('destinations'));
    }



}
