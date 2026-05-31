<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Attraction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Attraction $attraction)
    {
        $existingReview = $attraction->getUserReview(auth()->id());
        return view('reviews.create', compact('attraction', 'existingReview'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'fun_rating' => 'required|integer|min:1|max:10',
            'safety_rating' => 'required|integer|min:1|max:10',
            'value_rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:1000',
        ]);

        $attraction = Attraction::findOrFail($validated['attraction_id']);
        $existingReview = Review::where('user_id', auth()->id())
            ->where('attraction_id', $attraction->id)
            ->first();

        if ($existingReview) {
            $existingReview->fun_rating = $validated['fun_rating'];
            $existingReview->safety_rating = $validated['safety_rating'];
            $existingReview->value_rating = $validated['value_rating'];
            $existingReview->comment = $validated['comment'] ?? '';
            $existingReview->save();
        } else {
            Review::create([
                'user_id' => auth()->id(),
                'attraction_id' => $attraction->id,
                'fun_rating' => $validated['fun_rating'],
                'safety_rating' => $validated['safety_rating'],
                'value_rating' => $validated['value_rating'],
                'comment' => $validated['comment'] ?? '',
            ]);
        }

        $attraction->updateAverageRatings();

        // CHANGED: Redirect to map instead of attraction page
        return redirect()->route('map.index')
                       ->with('success', 'Review saved successfully!');
    }

    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            return redirect()->route('map.index')
                           ->with('error', 'You can only delete your own reviews');
        }

        $attraction = $review->attraction;
        $review->delete();
        $attraction->updateAverageRatings();

        // CHANGED: Redirect to map instead of attraction page
        return redirect()->route('map.index')
                       ->with('success', 'Review deleted successfully!');
    }
}
