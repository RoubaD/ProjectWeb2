@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff);
        color: #91766e;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        margin: auto;
        justify-content: space-between;
        align-items: flex-start;
    }

    .property-details, .map-container {
        flex: 1 1 48%;
        height: 500px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .property-details img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .map-container {
        overflow: hidden;
    }

    #map {
        width: 100%;
        height: 100%;
        border-radius: 15px;
    }

    .buttons-section {
        width: 100%;
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
        margin-top: 20px;
        padding: 0 20px; 
        gap: 515px;
    }

    .reserve-button {
         background: #91766e; 
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .back-button {
        display: inline-block; /* Ensures proper sizing */
        width: 50px; /* Set fixed width */
        height: 50px; /* Set fixed height */
        cursor: pointer;
        border: none;
        background: url('{{ asset("images/backbutton.png") }}') no-repeat center center;
        background-size: contain; /* Adjust to fit within the button size */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .back-button:hover {
        transform: scale(1.1); /* Slightly enlarge on hover */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }


    .reserve-button:hover {
        background: #b7a7a9;
    }

    .reserve-button {
        /* margin: 0 auto; Center the reserve button */
    }
</style>

<div class="container">
    <!-- Property Details Section -->
    <div class="property-details">
        <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}">
        <h1>{{ $destination->name }}</h1>
        <p><strong>Landmark:</strong> {{ $destination->landmark }}</p>
        <p><strong>Price:</strong> ${{ number_format($destination->price, 2) }} per night</p>
        <p><strong>Property Type:</strong> {{ $destination->property_type }}</p>
        <p><strong>Guest Capacity:</strong> {{ $destination->guest_capacity }}</p>
    </div>

    <div class="map-container">
        <div id="map"></div>
    </div>
</div>

<div class="buttons-section">
    <a href="{{ route('destinations') }}" class="back-button"></a>
    <button id="reserve-button" class="reserve-button">Reserve</button>

</div>

<script>
    let map;

    document.addEventListener("DOMContentLoaded", () => {
        function initMap() {
            const location = {
                lat: parseFloat("{{ $destination->latitude }}"),
                lng: parseFloat("{{ $destination->longitude }}")
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: location,
                zoom: 10,
            });

            new google.maps.Marker({
                position: location,
                map: map,
                title: "{{ $destination->name }}",
            });
        }

        initMap();
    });
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4dYsLxhDwxjH_pK5jkPm-KHGjZmRwFLY&callback=initMap"
    async
    defer>
</script>

@endsection
