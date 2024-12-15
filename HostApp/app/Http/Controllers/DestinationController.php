<?php

namespace App\Http\Controllers;
use App\Models\Wishlist;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $search = $request->query('search');

        $destinations = Destination::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('landmark', 'like', "%$search%")
                ->orWhere('property_type', 'like', "%$search%");
        })->paginate(6);

        
        foreach ($destinations as $destination) {
            $destination->amenities = is_array($destination->amenities)
                ? $destination->amenities
                : json_decode($destination->amenities, true);
        }
        $wishlist = Wishlist::where('user_id', $userId)->pluck('destination_id')->toArray();
        return view('destinations', compact('destinations', 'search','wishlist'));
    }


    

    public function getReservedDates($id)
    {
        $destination = Destination::findOrFail($id);
        $reservedDates = $destination->reservations->pluck('reserved_date');
        return response()->json($reservedDates);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $destinations = Destination::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('landmark', 'LIKE', '%' . $query . '%')
            ->orWhere('property_type', 'LIKE', '%' . $query . '%')
            ->get();

        foreach ($destinations as $destination) {
            $destination->amenities = json_decode($destination->amenities, true);
        }
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

    public function getDestinationById($id)
{
    $destination = Destination::findOrFail($id);

    $destination->amenities = is_array($destination->amenities)
        ? $destination->amenities
        : json_decode($destination->amenities, true);

    return $destination;
}


    





}
