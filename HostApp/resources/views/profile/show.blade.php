@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Profile</h1>

    <div class="profile-details">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <div class="profile-actions mt-4">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        <form action="{{ route('profile.destroy') }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <input type="password" name="password" placeholder="Enter password to delete" required>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Profile</button>
        </form>
    </div>
</div>
@endsection
