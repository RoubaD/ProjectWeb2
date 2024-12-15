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
    .custom-marker {
        position: absolute;
        background-color: #91766e;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transform: translate(-50%, -100%);
        white-space: nowrap;
    }

    .custom-marker span {
        display: inline-block;
    }

</style>

<div class="search-map-container">
    <h1>Explore Villas on the Map</h1>
    <div id="map"></div>
</div>

<script>
    let map;

    function initMap() {
        // Initialize the map centered on a default location
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 33.8938,
                lng: 35.5018
            }, // Example coordinates (Beirut)
            zoom: 10,
        });

        // Data for villas passed from the backend
        const destinations = @json($destinations);

        // Utility function to format price as $500k or $1.5M
        const formatPrice = (price) => {
            if (price >= 1000000) {
                return `$${(price / 1000000).toFixed(1)}M`;
            } else if (price >= 1000) {
                return `$${(price / 1000).toFixed(0)}k`;
            }
            return `$${price}`;
        };

        // Add markers for each villa
        destinations.forEach(destination => {
            const priceLabel = formatPrice(parseFloat(destination.price));

            // Create a custom HTML element for the marker
            const markerDiv = document.createElement("div");
            markerDiv.className = "custom-marker";
            markerDiv.innerHTML = `<span>${priceLabel}</span>`;

            // Create a custom overlay for the marker
            const customMarker = new google.maps.OverlayView();
            customMarker.onAdd = function () {
                const panes = this.getPanes();
                panes.overlayMouseTarget.appendChild(markerDiv);
            };
            customMarker.draw = function () {
                const position = this.getProjection().fromLatLngToDivPixel(
                    new google.maps.LatLng(destination.latitude, destination.longitude)
                );
                markerDiv.style.left = position.x + "px";
                markerDiv.style.top = position.y + "px";
            };
            customMarker.onRemove = function () {
                markerDiv.parentNode.removeChild(markerDiv);
            };
            customMarker.setMap(map);
        });
    }

    // Expose initMap globally for the Google Maps API callback
    window.initMap = initMap;
</script>



<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4dYsLxhDwxjH_pK5jkPm-KHGjZmRwFLY&callback=initMap"
    async
    defer
    loading="lazy"></script>
@endsection