<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialLoginController extends Controller
{
    /**
     * Redirect to Google for authentication.
     * If on the register page, ensure Google shows the account selection screen.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) // Ensures Google shows the account selection page
            ->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve user information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user exists in the database
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // If the user exists, log them in
                Auth::login($existingUser);

                return redirect()->route('welcome')->with('success', 'You are now logged in!');
            } else {
                // If the user doesn't exist, create a new user in the database
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(), // Save the Google ID
                    'password' => Hash::make(uniqid()), // Generate a random password
                ]);

                // Log the new user in
                Auth::login($newUser);

                return redirect()->route('welcome')->with('success', 'Account created successfully! You are now logged in.');
            }
        } catch (\Exception $e) {
            // Redirect back to the login or register page with an error message if something fails
            return redirect()->route('register')->with('error', 'Failed to authenticate with Google.');
        }
    }
}
