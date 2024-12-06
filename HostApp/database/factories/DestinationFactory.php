<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(2, true), // Generate unique names
            'landmark' => $this->faker->address,              // Random address
            'price' => $this->faker->randomFloat(2, 100000, 1000000), // Price between 100k and 1M
            'property_type' => $this->faker->randomElement(['Villa', 'Apartment', 'Studio', 'Cabin', 'Lodge']), // Random type
            'amenities' => json_encode($this->faker->randomElements(
                ['Wi-Fi', 'Pool', 'Parking', 'Air Conditioning', 'Fireplace'], 
                $this->faker->numberBetween(1, 4)
            )), // Random amenities
            'guest_capacity' => $this->faker->numberBetween(1, 12), // Random guest capacity
            'availability' => json_encode($this->generateRandomDates()), // Random availability dates
            'image' => $this->faker->imageUrl(640, 480, 'house', true), // Random house image
            'latitude' => $this->faker->latitude(33.0, 34.0), // Random latitude in the specified range
            'longitude' => $this->faker->longitude(35.0, 36.0), // Random longitude in the specified range
        ];
    }

    /**
     * Generate an array of random dates between two specified dates.
     *
     * @return array
     */
    private function generateRandomDates()
    {
        $dates = [];
        $startDate = Carbon::createFromFormat('Y-m-d', '2024-12-01');
        $endDate = Carbon::createFromFormat('Y-m-d', '2025-01-01');

        for ($i = 0; $i < 5; $i++) {
            $dates[] = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        }

        return $dates;
    }
}
