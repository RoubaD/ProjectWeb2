<x-guest-layout>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fcece3, #ffffff); /* Matching vibe */
        }

        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            font-size: 1.8rem;
            color: #91766e;
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 15px;
        }

        .form-section label {
            display: block;
            font-size: 0.9rem;
            color: #91766e;
            margin-bottom: 5px;
        }

        .form-section input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-section input:focus {
            border-color: #91766e;
            outline: none;
            box-shadow: 0 0 5px rgba(145, 118, 110, 0.5);
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .back-button, .submit-button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .back-button {
            background: #ffffff;
            border: 1px solid #91766e;
            color: #91766e;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #91766e;
            color: #ffffff;
        }

        .submit-button {
            background: linear-gradient(135deg, #91766e, #b7a7a9);
            color: #ffffff;
        }

        .submit-button:hover {
            opacity: 0.9;
        }

        .google-login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            padding: 12px;
            background: #ffffff;
            color: #91766e;
            border: 1px solid #91766e;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .google-login-button:hover {
            background: #91766e;
            color: #ffffff;
        }

        .google-login-button img {
            height: 20px;
            margin-right: 10px;
        }
    </style>

    <div class="form-container">
        <h1 class="form-title">Register</h1>

        @if (session('error'))
            <div style="color: red; font-size: 0.9rem; text-align: center; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-section">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-section">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-section">
                <label for="phone">Phone</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-section">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-section">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="form-buttons">
                <a href="{{ route('welcome') }}" class="back-button">Back</a>
                <button type="submit" class="submit-button">Register</button>
            </div>
        </form>

        <!-- Google Login Button -->
        <a href="{{ route('login.google') }}" class="google-login-button">
            <img src="\images\GoogleLogo.svg" alt="Google Icon">
            Continue with Google
        </a>
    </div>
</x-guest-layout>
        