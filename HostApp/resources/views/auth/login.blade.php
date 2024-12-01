<x-guest-layout>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fcece3, #ffffff); /* Subtle gradient matching the site vibe */
        }

        .form-container {
            max-width: 450px;
            margin: 80px auto;
            padding: 30px 40px;
            background: #fff6f1; /* Soft off-white background */
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08); /* Subtle shadow */
        }

        .form-title {
            font-size: 2rem;
            color: #91766e; /* Muted pink */
            text-align: center;
            margin-bottom: 25px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section label {
            font-size: 0.95rem;
            color: #b7a7a9; /* Soft muted gray */
            margin-bottom: 5px;
            display: block;
        }

        .form-section input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2d6d3; /* Soft border color */
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fff9f7; /* Slightly soft input background */
        }

        .form-section input:focus {
            border-color: #91766e; /* Muted pink focus */
            outline: none;
            box-shadow: 0 0 5px rgba(145, 118, 110, 0.3);
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-password-link {
            font-size: 0.85rem;
            color: #91766e;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
            color: #b7a7a9; /* Darker muted tone */
        }

        .submit-button {
            padding: 12px 25px;
            background: linear-gradient(135deg, #91766e, #b7a7a9); /* Matching button gradient */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            transition: opacity 0.3s ease;
        }

        .submit-button:hover {
            opacity: 0.9;
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #b7a7a9;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .google-login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            padding: 12px 20px;
            background: #91766e; /* Soft muted pink */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            text-decoration: none;
            transition: background 0.3s ease, opacity 0.3s ease;
        }

        .google-login-button:hover {
            background: #b7a7a9; /* Slightly darker on hover */
        }

        .google-login-button img {
            margin-right: 10px;
            height: 20px;
        }
    </style>

    <div class="form-container">
        <h1 class="form-title">Log In</h1>
        @if (session('error'))
            <div style="color: red; font-size: 0.9rem;">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-section">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-section">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                <div style="color: red; font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-section">
                <label for="remember_me" class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    Remember me
                </label>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot your password?</a>
                @endif
                <button type="submit" class="submit-button">Log in</button>
            </div>
        </form>

        <!-- Google Login/Register Button -->
        <a href="{{ route('login.google') }}" class="google-login-button">
            <img src="\images\GoogleLogo.svg" alt="Google Icon">
            Continue with Google
        </a>

    </div>
</x-guest-layout>
