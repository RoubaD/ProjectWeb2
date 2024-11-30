@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff); /* Subtle gradient */
    }

    .hero-section {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        z-index: 1;
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        color: #ffffff;
        margin-bottom: 15px;
        z-index: 2;
    }

    .hero-text {
        font-size: 1.2rem;
        color: #ffffff;
        margin-bottom: 30px;
        z-index: 2;
    }

    .destination-button {
        padding: 12px 25px;
        font-size: 18px;
        color: #91766e;
        background-color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .destination-button:hover {
        background-color: #b7a7a9;
    }

    .waves-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    canvas {
        display: block;
        width: 100%;
        height: 100%;
    }

    .hero-image {
    position: absolute;
    z-index: -3;
    bottom: 10%;
    left: 50%;
    transform: translateX(-50%);
    max-width: 900px;
    width: 90%;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
</style>

<div class="waves-container">
    <canvas id="waves"></canvas>
</div>

<div class="hero-section">
    <h1 class="hero-title">Welcome to Nomadia</h1>
    <p class="hero-text">Your journey begins here. Explore breathtaking destinations.</p>
    <button class="destination-button" onclick="window.location.href='{{ route('destinations') }}'">Explore Destinations</button>

    <!-- Picture in front of waves -->
    <img src="{{ asset('images/background.jpg') }}" alt="Hero Image" class="hero-image">
</div>
@endsection
