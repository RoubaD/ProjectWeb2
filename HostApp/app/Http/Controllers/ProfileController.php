<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // Ensure the name is strictly alphabetical (no numbers or special characters)
            'name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/',
            
            // Ensure the email is unique, ignoring the current user's email
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            
            // Validate phone number to be at least 6 digits and no letters
            'phone' => 'required|string|max:15|regex:/^\d{6,}$/',
        ]);

        // Update user's profile information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
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
