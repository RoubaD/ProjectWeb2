<style>
    .reservation-card {
        background: var(--card-background);
        border-radius: 16px;
        box-shadow: var(--soft-shadow);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: row;
        border: 1px solid rgba(145, 118, 110, 0.1);
        transform-origin: center;
        min-height: 600px;
        max-height: 500px;
    }


    .reservation-card:hover {
        box-shadow: var(--hover-shadow);
        transform: translateY(-5px) scale(1.02);
    }

    .reservation-card img {
        width: 40%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }


    .reservation-card:hover img {
        transform: scale(1.05);
    }

    .reservation-details {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        width: 60%;
        overflow: auto;

    }

    .reservation-details h3 {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 10px;
        font-weight: 600;
    }

    .reservation-dates {
        display: flex;
        justify-content: space-between;
        background-color: rgba(145, 118, 110, 0.05);
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .reservation-dates p {
        margin: 0;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .reservation-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex-grow: 1;
    }

    .amenities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin-bottom: 15px;
    }

    .amenities-list li {
        background-color: rgba(145, 118, 110, 0.1);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        transition: background-color 0.2s ease;
    }

    .amenities-list li:hover {
        background-color: rgba(145, 118, 110, 0.15);
    }

    .reservation-details p {
        margin: 5px 0;
        font-size: 0.95rem;
        color: #5c5c5c;
    }

    .amenities-section {
        flex-grow: 1;
    }

    .price {
        font-weight: bold;
        font-size: 1.4rem;
        color: var(--primary-color);
        margin-top: auto;
        text-align: right;
        padding-top: 15px;
    }

    .pricing-location {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid rgba(145, 118, 110, 0.1);
    }

    .reservation-details p {
        margin: 5px 0;
        font-size: 0.95rem;
        color: #5c5c5c;
    }

    .location-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .location-link:hover {
        color: rgba(145, 118, 110, 0.7);
        text-decoration: underline;
    }

    .location-link::before {
        content: '📍';
        font-size: 1rem;
    }

    .download-invoice .btn {
    background-color: #91766e;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    display: inline-block;
}

.download-invoice .btn:hover {
    background-color: #a68471;
}


</style>

<div class="reservation-card">
    <img src="{{ asset($reservation->destinationDetails->image) }}" alt="{{ $reservation->destinationDetails->name }}">

    <div class="reservation-details">
        <h3>{{ $reservation->destinationDetails->name }}</h3>

        <div class="reservation-dates">
            <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($reservation->start_date)->format('M d, Y') }}</p>
            <p><strong>End:</strong> {{ \Carbon\Carbon::parse($reservation->end_date)->format('M d, Y') }}</p>
        </div>

        <div class="reservation-info">
            <p><strong>Landmark:</strong> {{ $reservation->destinationDetails->landmark ?? 'N/A' }}</p>
            <p><strong>Type:</strong> {{ $reservation->destinationDetails->property_type ?? 'N/A' }}</p>

            @if(!empty($reservation->destinationDetails->amenities))
                        <div class="amenities-section">
                            <p><strong>Amenities:</strong></p>
                            <ul class="amenities-list">
                                @php
                                    $amenities = is_string($reservation->destinationDetails->amenities)
                                        ? json_decode($reservation->destinationDetails->amenities, true)
                                        : $reservation->destinationDetails->amenities;
                                @endphp
                                @if(is_array($amenities))
                                    @foreach($amenities as $amenity)
                                        <li>{{ $amenity }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
            @endif

            <p><strong>Guest Capacity:</strong> {{ $reservation->destinationDetails->guest_capacity ?? 'N/A' }} guests
            </p>

            <div class="pricing-location">
                <p class="price">$ {{ number_format($reservation->destinationDetails->price, 2) }}</p>

                <p><strong>Location:</strong>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $reservation->destinationDetails->latitude }},{{ $reservation->destinationDetails->longitude }}"
                        target="_blank" class="location-link">
                        View on Google Maps
                    </a>
                </p>
            </div>
            <div class="download-invoice">
                <a href="{{ route('reservations.downloadInvoice', $reservation->id) }}" class="btn btn-primary">Download
                    Invoice</a>
                <a href="{{ route('reservations.downloadReceipt', $reservation->id) }}"
                    class="btn btn-secondary">Download Receipt</a>
            </div>
        </div>
    </div>
</div>