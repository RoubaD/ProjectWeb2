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
        align-items: center;
        margin: 0 auto;
        position: relative;
        margin-top: 20vh;
        /* Centers the search bar vertically */
        gap: 15px;
        /* Space between icons and the search bar */
    }

    .search-bar-container {
        flex-grow: 1;
        /* Search bar adapts to available space */
        max-width: 600px;
        /* Restricts the maximum width for the search bar */
    }

    .search-bar {
        width: 100%;
        /* Full width within its container */
        padding: 12px;
        /* Smaller padding for a more compact design */
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        /* Slightly smaller font size */
        outline: none;
        background-color: rgba(255, 255, 255, 0.15);
        color: #91766e;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease-in-out;
        backdrop-filter: blur(10px);
    }

    .search-bar::placeholder {
        color: rgba(145, 118, 110, 0.8);
        font-size: 1rem;
        /* Slightly smaller placeholder text */
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

    .filter-button,
    .map-search-button {
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .filter-button:hover,
    .map-search-button:hover {
        background-color: #b7a7a9;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .filter-button {
        background: url('images/filter.png') no-repeat center center;
        /* Replace with your filter icon */
        background-size: cover;
    }

    .map-search-button {
        background: url('images/location.png') no-repeat center center;
        /* Replace with your map icon */
        background-size: cover;
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
    .fa-heart {
    transition: color 0.3s ease;
}

.fa-heart.text-danger {
    color: red;
}

.fa-heart.text-secondary {
    color: #ccc;
}


</style>

<div class="hero-title">Explore Our Destinations</div>

<div class="search-container">
    <!-- Filter Button -->
    <a href="{{ route('detailedSearch') }}" class="filter-button" title="Filter Options"></a>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('destinations') }}" class="search-bar-container">
        <input type="text" name="search" placeholder="Explore destinations..." value="{{ request('search') }}"
            class="search-bar" />
        <button type="submit" style="display: none;">Search</button> <!-- Hidden button to enable form submission -->
    </form>


    <!-- Map Search Button -->
    <a href="{{ route('map.search') }}" class="map-search-button" title="Search on Map"></a>
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
                <p><strong>Amenities:</strong>
                    {{ is_array($destination->amenities)
            ? implode(', ', $destination->amenities)
            : implode(', ', json_decode($destination->amenities, true) ?? []) }}
                </p>
                <p><strong>Guest Capacity:</strong> {{ $destination->guest_capacity }}</p>
                <p class="price">$ {{ number_format($destination->price, 2) }}</p>

                <form action="{{ route('wishlist.store', $destination->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa fa-heart"></i> Add to Wishlist
                    </button>
                </form>
                <div class="button-container">
                    <a href="{{ route('destinations.show', ['id' => $destination->id]) }}" class="view-more-button">View
                        More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection