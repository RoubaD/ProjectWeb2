<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('destination')->get();

        return view('wishlist.index', compact('wishlists'));
    }

    // Add a new destination to the wishlist
    public function store(Request $request, $destinationId)
    {
        $userId = Auth::id();

        // Prevent duplicates
        Wishlist::firstOrCreate([
            'user_id' => $userId,
            'destination_id' => $destinationId,
        ]);

        return back()->with('success', 'Destination added to your wishlist!');
    }

    // Remove a destination from the wishlist
    public function destroy($destinationId)
    {
        $userId = Auth::id();

        Wishlist::where('user_id', $userId)
            ->where('destination_id', $destinationId)
            ->delete();

        return back()->with('success', 'Destination removed from your wishlist.');
    }

    public function toggle($id)
    {
        $userId = auth()->id();

        // Check if destination is already in the wishlist
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('destination_id', $id)
            ->first();

        if ($wishlist) {
            // Remove from wishlist
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => $userId,
                'destination_id' => $id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}