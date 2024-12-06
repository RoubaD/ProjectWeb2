@extends('layouts.app')

@section('content')
<div class="relative flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-[#fcece3] to-white overflow-hidden">
    <!-- Floating Decorative Shapes -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-[#91766e] rounded-full opacity-20 animate-floating"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-[#b7a7a9] rounded-full opacity-10 animate-floating"></div>

    <!-- Search Container -->
    <div class="w-full max-w-4xl p-8 bg-white shadow-lg rounded-xl search-container">
        <h2 class="text-3xl font-bold text-center text-[#91766e] mb-6">Search Destinations</h2>
        <form method="GET" action="{{ route('detailedSearch') }}" class="filter-form grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Price Range -->
            <div>
                <label for="price_min" class="block text-sm font-medium text-[#91766e]">Price (Min)</label>
                <input type="number" id="price_min" name="price_min" placeholder="Minimum Price"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-[#91766e]/50 focus:outline-none" value="{{ request('price_min') }}">
            </div>
            <div>
                <label for="price_max" class="block text-sm font-medium text-[#91766e]">Price (Max)</label>
                <input type="number" id="price_max" name="price_max" placeholder="Maximum Price"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-[#91766e]/50 focus:outline-none" value="{{ request('price_max') }}">
            </div>

            <!-- Property Type -->
            <div>
                <label for="property_type" class="block text-sm font-medium text-[#91766e]">Property Type</label>
                <select id="property_type" name="property_type"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-[#91766e]/50 focus:outline-none">
                    <option value="">Any</option>
                    <option value="apartment" {{ request('property_type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="villa" {{ request('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                </select>
            </div>

            <!-- Amenities -->
            <div>
                <label for="amenities" class="block text-sm font-medium text-[#91766e]">Amenities</label>
                <select id="amenities" name="amenities[]" multiple
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-[#91766e]/50 focus:outline-none">
                    <option value="Wi-Fi" {{ in_array('Wi-Fi', (array)request('amenities')) ? 'selected' : '' }}>Wi-Fi</option>
                    <option value="Pool" {{ in_array('Pool', (array)request('amenities')) ? 'selected' : '' }}>Pool</option>
                    <option value="Parking" {{ in_array('Parking', (array)request('amenities')) ? 'selected' : '' }}>Parking</option>
                </select>
            </div>

            <!-- Guest Capacity -->
            <div>
                <label for="guest_capacity" class="block text-sm font-medium text-[#91766e]">Guest Capacity</label>
                <input type="number" id="guest_capacity" name="guest_capacity" placeholder="Minimum Guests"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-[#91766e]/50 focus:outline-none" value="{{ request('guest_capacity') }}">
            </div>

            <!-- Submit Button -->
            <div class="col-span-full text-center">
            <button type="submit"
                class="relative group px-6 py-3 text-white bg-gradient-to-r from-[#b7a7a9] to-[#91766e] rounded-lg hover:from-[#91766e] hover:to-[#b7a7a9] focus:outline-none focus:ring focus:ring-[#91766e]/50 overflow-hidden">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-[#91766e] to-[#b7a7a9] opacity-50 transition-transform duration-500 group-hover:translate-x-full rounded-lg"></span>
                <span class="relative">Search</span>
            </button>

            </div>
        </form>
    </div>

    <!-- Results Container -->
    <div class="property-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
        <!-- Results will be rendered here dynamically -->
    </div>
</div>
@endsection
