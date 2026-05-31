<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
        'type',
        'safety_status',
        'avg_fun_rating',
        'avg_safety_rating',
        'avg_value_rating',
        'review_count',
    ];

    protected $casts = [
        'avg_fun_rating' => 'float',
        'avg_safety_rating' => 'float',
        'avg_value_rating' => 'float',
    ];

    // Relationships
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Calculate and update average ratings
    public function updateAverageRatings()
{
    $reviews = $this->reviews()->get();

    if ($reviews->isEmpty()) {
        // No reviews - set to 0
        $this->avg_fun_rating = 0.00;
        $this->avg_safety_rating = 0.00;
        $this->avg_value_rating = 0.00;
        $this->review_count = 0;
        $this->save();
        return;
    }

    // Calculate averages
    $avgFun = round($reviews->avg('fun_rating'), 2);
    $avgSafety = round($reviews->avg('safety_rating'), 2);
    $avgValue = round($reviews->avg('value_rating'), 2);
    $count = $reviews->count();

    // Update directly
    $this->avg_fun_rating = $avgFun;
    $this->avg_safety_rating = $avgSafety;
    $this->avg_value_rating = $avgValue;
    $this->review_count = $count;
    $this->save();
}
    // public function updateAverageRatings()
    // {
    //     $reviews = $this->reviews()->get();

    //     \Log::info('Updating ratings for attraction: ' . $this->id . ', Review count: ' . $reviews->count());

    //     if ($reviews->isEmpty()) {
    //         $this->update([
    //             'avg_fun_rating' => 0,
    //             'avg_safety_rating' => 0,
    //             'avg_value_rating' => 0,
    //             'review_count' => 0,
    //         ]);
    //         \Log::info('No reviews, setting all ratings to 0');
    //         return;
    //     }

    //     $funAvg = round($reviews->avg('fun_rating'), 2);
    //     $safetyAvg = round($reviews->avg('safety_rating'), 2);
    //     $valueAvg = round($reviews->avg('value_rating'), 2);
    //     $count = $reviews->count();

    //     \Log::info("Attraction {$this->id} ratings - Fun: {$funAvg}, Safety: {$safetyAvg}, Value: {$valueAvg}, Count: {$count}");

    //     $this->update([
    //         'avg_fun_rating' => $funAvg,
    //         'avg_safety_rating' => $safetyAvg,
    //         'avg_value_rating' => $valueAvg,
    //         'review_count' => $count,
    //     ]);

    //     \Log::info('Attraction ratings updated successfully');
    // }

    // Get user's review for this attraction
    public function getUserReview($userId)
    {
        return $this->reviews()->where('user_id', $userId)->first();
    }
}
