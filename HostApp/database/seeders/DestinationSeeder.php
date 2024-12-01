<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::create([
            'name' => 'Luxury Villa',
            'landmark' => 'Near Jeita Grotto',
            'price' => 500000,
            'property_type' => 'Villa',
            'amenities' => json_encode(['Pool', 'Wi-Fi', 'Air Conditioning']),
            'guest_capacity' => 10,
            'image' => 'images/luxury_villa.jpg', // Add the image path
            'availability' => json_encode(['2024-12-15', '2024-12-16', '2024-12-20']), // Example dates
        ]);

        Destination::create([
            'name' => 'Beach Apartment',
            'landmark' => 'By Jounieh Bay',
            'price' => 300000,
            'property_type' => 'Apartment',
            'amenities' => json_encode(['Beach View', 'Wi-Fi', 'Kitchen']),
            'guest_capacity' => 4,
            'image' => 'images/beach_apartment.jpg', // Add the image path
            'availability' => json_encode(['2024-12-15', '2024-12-18', '2024-12-25']),
        ]);
    }
}
