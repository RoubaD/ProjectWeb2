@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #91766e;
        --background-gradient: linear-gradient(135deg, #fcece3, #ffffff);
        --card-background: #ffffff;
        --soft-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    body {
        margin: 0;
        font-family: 'Inter', 'Poppins', sans-serif;
        background: var(--background-gradient);
        color: var(--primary-color);
        line-height: 1.6;
    }

    .reservations-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .hero-title {
        font-size: 2.75rem;
        text-align: center;
        margin-bottom: 40px;
        color: var(--primary-color);
        font-weight: 600;
        letter-spacing: -0.5px;
    }

    .category-title {
        font-size: 1.75rem;
        color: var(--primary-color);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(145, 118, 110, 0.15);
        font-weight: 500;
    }

    .grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(600px, 1fr)); /* Increased width */
    gap: 25px;
    margin-bottom: 40px;
}

    .no-reservations {
        text-align: center;
        color: var(--primary-color);
        font-size: 1.1rem;
        background-color: rgba(145, 118, 110, 0.05);
        padding: 25px;
        border-radius: 12px;
        font-weight: 300;
    }

    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="reservations-container">
    <div class="hero-title">Your Reservations</div>

    @php
        $currentDate = now();
    @endphp

    @php
        $currentReservations = $reservations->filter(function ($reservation) use ($currentDate) {
            return \Carbon\Carbon::parse($reservation->start_date)->lte($currentDate) &&
                \Carbon\Carbon::parse($reservation->end_date)->gte($currentDate);
        });
    @endphp

    @php
        $upcomingReservations = $reservations->filter(function ($reservation) use ($currentDate) {
            return \Carbon\Carbon::parse($reservation->start_date)->gt($currentDate);
        });
    @endphp

    @php
        $pastReservations = $reservations->filter(function ($reservation) use ($currentDate) {
            return \Carbon\Carbon::parse($reservation->end_date)->lt($currentDate);
        });
    @endphp

    {{-- Current Reservations --}}
    <h2 class="category-title">Current Reservations</h2>
    @if($currentReservations->isEmpty())
        <div class="no-reservations">
            You have no current reservations.
        </div>
    @else
        <div class="grid-container">
            @foreach($currentReservations as $reservation)
                @include('reservations.card', ['reservation' => $reservation])
            @endforeach
        </div>
    @endif

    {{-- Upcoming Reservations --}}
    <h2 class="category-title">Upcoming Reservations</h2>
    @if($upcomingReservations->isEmpty())
        <div class="no-reservations">
            You have no upcoming reservations.
        </div>
    @else
        <div class="grid-container">
            @foreach($upcomingReservations as $reservation)
                @include('reservations.card', ['reservation' => $reservation])
            @endforeach
        </div>
    @endif

    {{-- Past Reservations --}}
    <h2 class="category-title">Past Reservations</h2>
    @if($pastReservations->isEmpty())
        <div class="no-reservations">
            You have no past reservations.
        </div>
    @else
        <div class="grid-container">
            @foreach($pastReservations as $reservation)
                @include('reservations.card', ['reservation' => $reservation])
            @endforeach
        </div>
    @endif
</div>
@endsection