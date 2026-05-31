<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Attraction;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample locations
        $locations = [
            [
                'name' => 'Disneyland',
                'description' => 'The Happiest Place on Earth with magical attractions',
                'latitude' => 33.8121,
                'longitude' => -117.9190,
                'address' => '1313 Disneyland Dr',
                'city' => 'Anaheim',
                'state' => 'CA',
                'country' => 'USA',
                'verified' => true,
            ],
            [
                'name' => 'Universal Studios',
                'description' => 'Movie-themed park with thrilling rides',
                'latitude' => 34.1381,
                'longitude' => -118.3536,
                'address' => '100 Universal City Plaza',
                'city' => 'Universal City',
                'state' => 'CA',
                'country' => 'USA',
                'verified' => true,
            ],
            [
                'name' => 'Six Flags Magic Mountain',
                'description' => 'Thrill seeker paradise with roller coasters',
                'latitude' => 34.4266,
                'longitude' => -118.5957,
                'address' => '26101 Magic Mountain Parkway',
                'city' => 'Valencia',
                'state' => 'CA',
                'country' => 'USA',
                'verified' => true,
            ],
        ];

        foreach ($locations as $locationData) {
            $location = Location::create($locationData);

            // Add sample attractions
            $attractions = match($location->name) {
                'Disneyland' => [
                    ['name' => 'Space Mountain', 'type' => 'Roller Coaster', 'description' => 'Space-themed roller coaster'],
                    ['name' => 'Haunted Mansion', 'type' => 'Dark Ride', 'description' => 'Spooky dark ride'],
                    ['name' => 'Pirates of the Caribbean', 'type' => 'Dark Ride', 'description' => 'Classic pirate adventure'],
                ],
                'Universal Studios' => [
                    ['name' => 'Jurassic World VelociCoaster', 'type' => 'Roller Coaster', 'description' => 'Dinosaur-themed coaster'],
                    ['name' => 'Harry Potter and the Forbidden Journey', 'type' => 'Dark Ride', 'description' => 'Wizarding world ride'],
                ],
                'Six Flags Magic Mountain' => [
                    ['name' => 'Millennium Force', 'type' => 'Roller Coaster', 'description' => 'Extreme speed coaster'],
                    ['name' => 'The Ninja', 'type' => 'Roller Coaster', 'description' => 'Suspended coaster'],
                ],
                default => [],
            };

            foreach ($attractions as $attractionData) {
                Attraction::create(array_merge($attractionData, [
                    'location_id' => $location->id,
                    'safety_status' => 'safe',
                ]));
            }
        }
    }
}
