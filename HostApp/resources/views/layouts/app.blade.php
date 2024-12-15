<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->


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
            justify-content: end;
            align-items: center;
        }

        .logo-container img {
            width: 110px;
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
            color: #91766e;
            border: 1px solid #91766e;
            border-radius: 5px;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 0.9rem;
            width: 100%;
            /* text-align: left; */
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

        main {
            margin-top: 70px;
        }

        .drawer {
            position: fixed;
            top: 0;
            left: -250px; 
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 2000;
            padding: 20px;
        }

        .drawer a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #91766e;
            transition: background-color 0.3s;
        }

        .drawer a:hover {
            background-color: #91766e;
            color: #ffffff;
        }

        .close-drawer {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #91766e;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .drawer-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #91766e;
            cursor: pointer;
            margin-left: 10px;
        }

    </style>

    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="dashboard-container">
            <div class="dashboard-inner">
                <button id="drawer-toggle" class="drawer-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="logo-container">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/Logo.svg') }}" alt="Logo">
                    </a>              
                </div>
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

        <!-- Drawer Menu -->
        <div id="drawer" class="drawer">
            <button id="close-drawer" class="close-drawer">&times;</button>
            <a href="{{ route('welcome') }}">Home</a>
            <a href="{{ route('destinations') }}">Destinations</a>
            <a href="{{ route('contact') }}">Contact Us</a>
            @auth
                <a href="{{ route('reservations.index') }}">My Reservations</a>
                <a href="{{ route('wishlist.index') }}">
                    <i class="fa fa-heart"></i> Wishlist
                </a>
            @endauth
        </div>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const drawer = document.getElementById('drawer');
            const toggleButton = document.getElementById('drawer-toggle');
            const closeButton = document.getElementById('close-drawer');

            // Open Drawer
            toggleButton.addEventListener('click', () => {
                drawer.style.left = '0';
            });

            // Close Drawer
            closeButton.addEventListener('click', () => {
                drawer.style.left = '-250px';
            });
        });
    </script>

</body>

</html>