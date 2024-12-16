<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Show Contact Page
    public function show()
    {
        $messages = ContactMessage::latest()->get();
        return view('contact', compact('messages'));
    }

    // Handle Form Submission
    public function submit(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Save the message to the database
        ContactMessage::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}

