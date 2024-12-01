<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile edit form.
     */
    public function edit(): \Illuminate\View\View
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile.edit', compact('user')); // Show edit profile form
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15', // Add validation for phone
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Update the phone field
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        // Log out the user
        Auth::logout();
    
        // Delete the user
        $user->delete();
    
        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success', 'Account deleted successfully.');
    }
    

}
