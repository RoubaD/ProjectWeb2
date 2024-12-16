@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff);
        color: #333;
        margin: 0;
        padding: 0;
    }

    .contact-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 50px;
    }

    .contact-form {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        width: 400px;
    }

    .contact-form h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    input, textarea {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background: #91766e;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s;
    }

    button:hover {
        background: #b7a7a9;
    }

    .messages-container {
        background: #fff;
        padding: 20px;
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        background: #f9f9f9;
        border-left: 4px solid #91766e;
        border-radius: 5px;
    }

    .message strong {
        color: #91766e;
    }

    .success-message {
        color: green;
        text-align: center;
    }
</style>

<div class="contact-container">
    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Contact Us</h2>
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>

    <!-- Messages Display -->
    <div class="messages-container">
        <h3>Real-Time Contact Messages</h3>
        @foreach ($messages as $message)
            <div class="message">
                <strong>{{ $message->name }}:</strong>
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>

@endsection
