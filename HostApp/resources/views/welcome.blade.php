@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff);
    }

    .hero-section {
        position: relative;
        height: 100vh;
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 40px;
    }

    .brand-title {
        position: absolute;
        top: 20px;
        right: 40px;
        font-size: 2rem;
        font-weight: bold;
        color: #ffffff;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 10;
    }

    .destination-button {
        position: absolute;
        top: 60%; /* Adjust to slightly below the center */
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 15px 30px;
        font-size: 18px;
        color: #91766e;
        background-color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .destination-button:hover {
        background-color: #b7a7a9;
    }

    .info-tabs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 40px;
        background-color: #ffffff;
        box-shadow: 0px -5px 10px rgba(0, 0, 0, 0.1);
    }

    .info-tab {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: linear-gradient(135deg, #fefefe, #f8f8f8);
    }

    .info-tab:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .info-number {
        font-size: 2rem;
        color: #91766e;
    }

    .info-title {
        font-size: 1rem;
        color: #555;
        margin-top: 10px;
    }
</style>

<div class="hero-section">
    <div class="brand-title">Nomadia</div>
    <button class="destination-button" onclick="window.location.href='{{ route('destinations') }}'">Explore Destinations</button>
</div>

<div class="info-tabs">
    <div class="info-tab">
        <span class="info-number">25K+</span>
        <p class="info-title">Happy Clients</p>
    </div>
    <div class="info-tab">
        <span class="info-number">560+</span>
        <p class="info-title">Completed Projects</p>
    </div>
    <div class="info-tab">
        <span class="info-number">100K+</span>
        <p class="info-title">Property Sales</p>
    </div>
    <div class="info-tab">
        <span class="info-number">15+</span>
        <p class="info-title">Years Experience</p>
    </div>
</div>
@endsection
