<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'address',
        'city',
        'state',
        'country',
        'verified',
    ];

    protected $casts = [
        'verified' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relationships
    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    // Get all reviews for all attractions at this location
    public function reviews()
    {
        return Review::whereIn('attraction_id',
            $this->attractions()->pluck('id')
        );
    }

    // Helper method to calculate average ratings for location
    public function getAverageRatings()
    {
        $reviews = $this->reviews()->get();

        if ($reviews->isEmpty()) {
            return [
                'fun' => 0,
                'safety' => 0,
                'value' => 0,
            ];
        }

        return [
            'fun' => round($reviews->avg('fun_rating'), 2),
            'safety' => round($reviews->avg('safety_rating'), 2),
            'value' => round($reviews->avg('value_rating'), 2),
        ];
    }
}
