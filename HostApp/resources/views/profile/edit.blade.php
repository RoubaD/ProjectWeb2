@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fcece3; /* Beige background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
    }

    .profile-edit-container {
        background-color: #ffffff; /* White background for the form */
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 400px;
    }

    .profile-edit-container h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #91766e;
    }

    .profile-edit-container label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
        font-size: 14px;
        color: #91766e;
    }

    .profile-edit-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #b7a7a9;
        border-radius: 5px;
        font-size: 14px;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .profile-edit-container button {
        background-color: #91766e;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        flex: 1;
        margin: 0 5px;
    }

    .profile-edit-container button:hover {
        background-color: #b7a7a9;
        color: #000000;
    }

    .delete-btn {
        background-color: #fcece3;
        color: #91766e;
        border: 1px solid #91766e;
    }

    .delete-btn:hover {
        background-color: #91766e;
        color: #ffffff;
    }

    /* Custom SweetAlert2 styles */
    .swal2-popup {
        background-color: rgba(255, 247, 242, 0.9) !important; /* Light beige */
        color: #91766e !important; /* Muted pink text */
        border: 1px solid #b7a7a9 !important; /* Lighter muted border */
        border-radius: 15px !important; /* Rounded corners */
        font-family: 'Poppins', sans-serif !important;
    }

    .swal2-title {
        color: #91766e !important;
        font-size: 20px !important;
    }

    .swal2-content {
        font-size: 16px !important;
        color: #555 !important; /* Neutral text for the message */
    }

    .swal2-confirm {
        background-color: #91766e !important; /* Muted pink button */
        color: #ffffff !important; /* White text */
        border: none !important;
        border-radius: 5px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
    }

    .swal2-cancel {
        background-color: #fcece3 !important; /* Beige button */
        color: #91766e !important; /* Muted pink text */
        border: 1px solid #91766e !important; /* Muted pink border */
        border-radius: 5px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
    }

    .swal2-actions button {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important;
    }
</style>

<div class="profile-edit-container">
    <h2>Edit Profile</h2>
    <form id="update-form" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <!-- Buttons -->
        <div class="button-group">
            <!-- Save Changes Button -->
            <button type="button" id="save-changes-btn">Save Changes</button>

            <!-- Delete Account Button -->
            <button type="button" id="delete-account-btn" class="delete-btn">
                Delete Account
            </button>
        </div>
    </form>

    <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButton = document.getElementById('delete-account-btn');
        const deleteForm = document.getElementById('delete-account-form');
        const saveChangesButton = document.getElementById('save-changes-btn');
        const updateForm = document.getElementById('update-form');

        // Delete Confirmation
        deleteButton.addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone. Your account will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#91766e',
                cancelButtonColor: '#fcece3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });

        // Save Changes Confirmation
        saveChangesButton.addEventListener('click', function () {
            Swal.fire({
                title: 'Success!',
                text: 'Your profile has been updated successfully.',
                icon: 'success',
                confirmButtonColor: '#91766e',
                confirmButtonText: 'OK',
            }).then(() => {
                updateForm.submit();
            });
        });

        // Delete Success Feedback
        @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#91766e',
            confirmButtonText: 'OK',
        });
        @endif

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif

    });
</script>
@endsection
