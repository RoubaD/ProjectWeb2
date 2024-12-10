<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fcece3 0%, #ffffff 100%);
            overflow-x: hidden;
        }

        /* Dashboard Styles */
        .dashboard-container {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .dashboard-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            flex: 1;
        }

        .nav-menu a {
            text-decoration: none;
            color: #91766e;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover {
            background-color: #b7a7a9;
            color: #ffffff;
        }

        .logo-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container img {
            width: 70px;
            /* Adjustable width */
            height: auto;
            /* Maintains aspect ratio */
        }

        .user-section {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .register-login-buttons a {
            text-decoration: none;
            color: #91766e;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
            margin-left: 10px;
            border: 1px solid #91766e;
            background: linear-gradient(135deg, #ffffff 0%, #fcece3 100%);
            transition: all 0.3s ease;
        }

        .register-login-buttons a:hover {
            background: linear-gradient(135deg, #91766e 0%, #b7a7a9 100%);
            color: #ffffff;
        }

        /* Dropdown Container */
        .dropdown {
            position: relative;
            display: inline-block;
            width: 150px;
            /* Set the width of the button and dropdown */
        }

        /* Dropdown Button */
        .dropdown-button {
            background: rgba(145, 118, 110, 0.2);
            /* Less solid background */
            color: #91766e;
            border: 1px solid #91766e;
            border-radius: 5px;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 0.9rem;
            /* Smaller font size */
            width: 100%;
            /* Same width as the dropdown menu */
            text-align: left;
            /* Align text to the left for consistency */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-button:hover {
            background-color: rgba(145, 118, 110, 0.4);
            /* Slightly darker on hover */
            color: #fff;
            /* Text changes to white on hover */
        }

        /* Dropdown Menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            width: 100%;
            /* Matches the button width */
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 10px;
            color: #91766e;
            text-decoration: none;
            font-size: 0.9rem;
            /* Smaller font size */
            border: none;
            background: none;
            text-align: left;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #91766e;
            color: #ffffff;
        }

        /* Logout Form */
        .logout-form {
            margin: 0;
            padding: 0;
        }

        .logout-form button {
            width: 100%;
            padding: 10px;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            font-size: 0.9rem;
            color: #91766e;
        }

        .logout-form button:hover {
            background: #91766e;
            color: #ffffff;
        }

        /* Content */
        main {
            margin-top: 70px;
            /* Space for fixed dashboard */
        }
    </style>

    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <!-- Fixed Dashboard -->
        <div class="dashboard-container">
            <div class="dashboard-inner">
                <!-- Left Navigation Menu -->
                <div class="nav-menu">
                    <a href="{{ route('welcome') }}">Home</a>
                    <a href="{{ route('destinations') }}">Destinations</a>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </div>

                <!-- Logo in the Center -->
                <div class="logo-container">
                    <img src="{{ asset('images/Logo.svg') }}" alt="Logo">
                </div>

                <!-- Right Section -->
                <div class="user-section">
                    @auth
                    <div class="dropdown">
                        <button class="dropdown-button">
                            {{ auth()->user()->name ?? auth()->user()->username ?? 'Traveler' }}
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="register-login-buttons">
                        <a href="{{ route('register') }}">Register</a>
                        <a href="{{ route('login') }}">Login</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')

</body>

</html>