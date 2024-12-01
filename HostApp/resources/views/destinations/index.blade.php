@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff);
        color: #91766e;
    }

    .hero-title {
        font-size: 2.5rem;
        text-align: center;
        margin: 30px 0;
        color: #91766e;
    }

    .search-container {
        display: flex;
        justify-content: center;
        margin: 40px 0;
        position: relative;
    }

    .search-bar {
        width: 70%;
        max-width: 800px;
        padding: 18px;
        border: none;
        border-radius: 50px;
        font-size: 1.3rem;
        outline: none;
        background-color: rgba(255, 255, 255, 0.15);
        color: #91766e;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease-in-out;
        backdrop-filter: blur(10px);
    }

    .search-bar::placeholder {
        color: rgba(145, 118, 110, 0.8);
        font-size: 1.1rem;
        text-align: center;
    }

    .search-bar:focus {
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(145, 118, 110, 0.6), 0 0 30px rgba(145, 118, 110, 0.4);
        background-color: rgba(255, 255, 255, 0.25);
    }

    .search-bar:hover {
        border-radius: 25px;
        background-color: rgba(255, 255, 255, 0.3);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 15px rgba(145, 118, 110, 0.6);
        }
        50% {
            box-shadow: 0 0 25px rgba(145, 118, 110, 0.3);
        }
        100% {
            box-shadow: 0 0 15px rgba(145, 118, 110, 0.6);
        }
    }

    .search-bar:focus {
        animation: pulse 1.5s infinite;
    }

    .map-search-button {
        background-color: #91766e;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-left: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .map-search-button:hover {
        background-color: #b7a7a9;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .map-search-button i {
        font-size: 1.2rem;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .destination-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .destination-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .destination-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .destination-details {
        padding: 20px;
    }

    .destination-details h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .destination-details p {
        margin: 5px 0;
        font-size: 0.9rem;
        color: #555;
    }

    .price {
        font-weight: bold;
        font-size: 1.2rem;
        color: #91766e;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .view-more-button {
        background: #91766e;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-more-button:hover {
        background: #b7a7a9;
    }
</style>

<div class="hero-title">Explore Our Destinations</div>

<div class="search-container">
    <form method="GET" action="{{ route('destinations') }}">
        <input 
            type="text" 
            name="search" 
            placeholder="Explore destinations..." 
            value="{{ request('search') }}" 
            class="search-bar"
        />
    </form>
    <!-- Map Search Button -->
    <a href="{{ route('map.search') }}" class="map-search-button" title="Search on Map">
        <i class="fas fa-map-marker-alt"></i>
    </a>

</div>


<div class="grid-container">
    @foreach ($destinations as $destination)
        <div class="destination-card">
            <!-- Destination Image -->
            <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}">

            <!-- Destination Details -->
            <div class="destination-details">
                <h3>{{ $destination->name }}</h3>
                <p><strong>Landmark:</strong> {{ $destination->landmark }}</p>
                <p><strong>Type:</strong> {{ $destination->property_type }}</p>
                <p><strong>Amenities:</strong> {{ implode(', ', json_decode($destination->amenities, true)) }}</p>
                <p><strong>Guest Capacity:</strong> {{ $destination->guest_capacity }}</p>
                <p class="price">$ {{ number_format($destination->price, 2) }}</p>

                <!-- Button -->
                <div class="button-container">
                    <a href="#" class="view-more-button">View More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
