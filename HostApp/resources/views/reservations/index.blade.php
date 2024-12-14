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

.grid-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.reservation-card {
    flex: 0 1 calc(33.333% - 20px); /* Three cards per row with gap consideration */
    max-width: 400px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}

.reservation-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
}

.reservation-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.reservation-details {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.reservation-details h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.reservation-details p {
    margin: 5px 0;
    font-size: 0.9rem;
    color: #555;
}

.price {
    font-weight: bold;
    font-size: 1.2rem;
    color: #91766e;
    margin-top: auto; /* Pushes price to bottom of card */
}

.no-reservations {
    text-align: center;
    color: #91766e;
    font-size: 1.2rem;
    margin-top: 50px;
}

.amenities-list {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 10px;
}

.amenities-list li {
    background-color: rgba(145, 118, 110, 0.1);
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .reservation-card {
        flex: 0 1 calc(50% - 20px); /* Two cards per row */
    }
}

@media (max-width: 768px) {
    .reservation-card {
        flex: 0 1 100%; /* One card per row */
    }
}
</style>

<div class="hero-title">Your Reservations</div>

@if($reservations->isEmpty())
    <div class="no-reservations">
        You have no reservations.
    </div>
@else
    <div class="grid-container">
        @foreach($reservations as $reservation)
        <div class="reservation-card">
            <!-- Reservation Image -->
            <img src="{{ asset($reservation->destinationDetails->image) }}" alt="{{ $reservation->destinationDetails->name }}">

            <!-- Reservation Details -->
            <div class="reservation-details">
                <h3>{{ $reservation->destinationDetails->name }}</h3>
                <p><strong>Reserved Date:</strong> {{ $reservation->reserved_date }}</p>
                <p><strong>Landmark:</strong> {{ $reservation->destinationDetails->landmark }}</p>
                <p><strong>Type:</strong> {{ $reservation->destinationDetails->property_type }}</p>
                
                @if(!empty($reservation->destinationDetails->amenities))
                    <p><strong>Amenities:</strong></p>
                    <ul class="amenities-list">
                        @foreach(is_array($reservation->destinationDetails->amenities) 
                                ? $reservation->destinationDetails->amenities 
                                : json_decode($reservation->destinationDetails->amenities, true) as $amenity)
                            <li>{{ $amenity }}</li>
                        @endforeach
                    </ul>
                @endif

                <p><strong>Guest Capacity:</strong> {{ $reservation->destinationDetails->guest_capacity }} guests</p>
                <p class="price">$ {{ number_format($reservation->destinationDetails->price, 2) }}</p>
                
                <p><strong>Location:</strong> 
                    Lat: {{ $reservation->destinationDetails->latitude }}, 
                    Long: {{ $reservation->destinationDetails->longitude }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection