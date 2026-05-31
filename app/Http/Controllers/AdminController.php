<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Attraction;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'locations_count' => Location::count(),
            'attractions_count' => Attraction::count(),
            'reviews_count' => Review::count(),
            'users_count' => User::count(),
            'unverified_locations' => Location::where('verified', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // ===== LOCATIONS =====

    public function indexLocations()
    {
        $locations = Location::with('attractions')->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function createLocation()
    {
        return view('admin.locations.create');
    }

    public function storeLocation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
            'verified' => 'nullable|boolean',
        ]);

        Location::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'description' => $validated['description'],
            'verified' => $validated['verified'] ?? false,
        ]);

        return redirect()->route('admin.locations.index')
                       ->with('success', 'Location added successfully!');
    }

    public function showLocation(Location $location)
    {
        $location->load('attractions');
        return view('admin.locations.show', compact('location'));
    }

    public function editLocation(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function updateLocation(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
            'verified' => 'nullable|boolean',
        ]);

        $location->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'description' => $validated['description'],
            'verified' => $validated['verified'] ?? $location->verified,
        ]);

        return redirect()->route('admin.locations.show', $location)
                       ->with('success', 'Location updated successfully!');
    }

    public function destroyLocation(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')
                       ->with('success', 'Location deleted successfully!');
    }

    // Verify locations
    public function verifyLocation(Location $location)
    {
        $location->update(['verified' => true]);

        return redirect()->back()->with('success', 'Location verified');
    }

    public function unverifyLocation(Location $location)
    {
        $location->update(['verified' => false]);

        return redirect()->back()->with('success', 'Location unverified');
    }

    // ===== ATTRACTIONS =====

    public function createAttraction(Location $location)
    {
        return view('admin.attractions.create', compact('location'));
    }

    public function storeAttraction(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'safety_status' => 'nullable|string|max:100',
        ]);

        Attraction::create([
            'location_id' => $validated['location_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'safety_status' => $validated['safety_status'],
            'avg_fun_rating' => 0,
            'avg_safety_rating' => 0,
            'avg_value_rating' => 0,
            'review_count' => 0,
        ]);

        $location = Location::find($validated['location_id']);
        return redirect()->route('admin.locations.show', $location)
                       ->with('success', 'Attraction added successfully!');
    }

    // Reviews

    public function indexReviews()
    {
    $reviews = Review::with('user', 'attraction')
        ->latest()
        ->paginate(15);

    return view('admin.reviews.index', compact('reviews'));
    }

    public function destroyReview(Review $review)
    {
        $attraction = $review->attraction;
        $review->delete();
        $attraction->updateAverageRatings();

        return redirect()->route('admin.reviews.index')
                       ->with('success', 'Review deleted successfully!');
    }
}
