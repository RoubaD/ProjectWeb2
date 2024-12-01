@extends('layouts.app')

@section('content')
<style>
    #map {
        width: 100%;
        height: 600px;
        margin-top: 20px;
        border-radius: 15px;
    }

    .search-map-container {
        padding: 20px;
        text-align: center;
    }
</style>

<div class="search-map-container">
    <h1>Explore Villas on the Map</h1>
    <div id="map"></div>
</div>

<script>
    let map;

    function initMap() {
        // Initialize map centered on a default location
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 33.8938, lng: 35.5018 }, // Example coordinates (Beirut)
            zoom: 10,
        });

        // Data for villas passed from the backend
        const destinations = @json($destinations);

        // Add markers for each villa
        destinations.forEach(destination => {
            const marker = new google.maps.Marker({
                position: { 
                    lat: parseFloat(destination.latitude), 
                    lng: parseFloat(destination.longitude) 
                },
                map: map,
                title: destination.name, // Tooltip for the marker
            });

            // Add an info window to display property details
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h4>${destination.name}</h4>
                        <p><strong>Landmark:</strong> ${destination.landmark}</p>
                        <p><strong>Type:</strong> ${destination.property_type}</p>
                        <p><strong>Price:</strong> $${parseFloat(destination.price).toFixed(2)}</p>
                    </div>
                `,
            });

            // Show info window when the marker is clicked
            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        });
    }

    // Expose initMap globally for the Google Maps API callback
    window.initMap = initMap;
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4dYsLxhDwxjH_pK5jkPm-KHGjZmRwFLY&callback=initMap"
    async
    defer
    loading="lazy"
></script>
@endsection
