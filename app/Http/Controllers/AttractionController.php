<?php
namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Location;
use App\Models\Review;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    // Show attraction details with reviews
    public function show(Request $request, Attraction $attraction)
    {
        $reviews = $attraction->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $userReview = null;
        if (auth()->check()) {
            $userReview = $attraction->getUserReview(auth()->id());
        }

        return view('attractions.show', compact('attraction', 'reviews', 'userReview'));
    }

    // Get reviews as JSON (for AJAX)
    public function getReviews(Attraction $attraction)
    {
        $reviews = $attraction->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'user_name' => $review->user->name,
                    'fun_rating' => $review->fun_rating,
                    'safety_rating' => $review->safety_rating,
                    'value_rating' => $review->value_rating,
                    'overall_rating' => $review->getOverallRating(),
                    'comment' => $review->comment,
                    'created_at' => $review->created_at->format('M d, Y'),
                    'can_edit' => auth()->check() && auth()->id() === $review->user_id,
                ];
            });

        return response()->json([
            'attraction' => [
                'id' => $attraction->id,
                'name' => $attraction->name,
                'type' => $attraction->type,
                'description' => $attraction->description,
                'safety_status' => $attraction->safety_status,
                'avg_fun_rating' => $attraction->avg_fun_rating,
                'avg_safety_rating' => $attraction->avg_safety_rating,
                'avg_value_rating' => $attraction->avg_value_rating,
                'review_count' => $attraction->review_count,
            ],
            'reviews' => $reviews,
        ]);
    }

    // Create (admin only)
    public function store(Request $request)
    {
        $this->authorize('create', Attraction::class);

        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $attraction = Attraction::create($validated);

        return redirect()->route('admin.locations.show', $request->location_id)
                       ->with('success', 'Attraction created successfully');
    }

    // Update (admin only)
    public function update(Request $request, Attraction $attraction)
    {
        $this->authorize('update', $attraction);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'safety_status' => 'in:safe,under_review,closed',
        ]);

        $attraction->update($validated);

        return redirect()->route('admin.locations.show', $attraction->location_id)
                       ->with('success', 'Attraction updated successfully');
    }

    // Delete (admin only)
    public function destroy(Attraction $attraction)
    {
        $this->authorize('delete', $attraction);

        $location_id = $attraction->location_id;
        $attraction->delete();

        return redirect()->route('admin.locations.show', $location_id)
                       ->with('success', 'Attraction deleted successfully');
    }
}
