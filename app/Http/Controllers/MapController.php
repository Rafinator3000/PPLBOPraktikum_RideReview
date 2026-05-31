<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    // Show the main map page
    public function index()
    {
        return view('map.index');
    }

    // Get all locations as JSON for map
    public function getLocations()
    {
        $locations = Location::where('verified', true)
            ->with('attractions')
            ->get()
            ->map(function ($location) {
                return [
                    'id' => $location->id,
                    'name' => $location->name,
                    'latitude' => (float)$location->latitude,
                    'longitude' => (float)$location->longitude,
                    'description' => $location->description,
                    'address' => $location->address,
                    'city' => $location->city,
                    'attractions_count' => $location->attractions->count(),
                ];
            });

        return response()->json($locations);
    }

    // Get specific location details
    public function showLocation($id)
    {
        $location = Location::with('attractions.reviews.user')->findOrFail($id);

        return view('locations.show', compact('location'));
    }

    // Search locations
    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $locations = Location::where('verified', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('city', 'LIKE', "%{$query}%")
                  ->orWhere('address', 'LIKE', "%{$query}%");
            })
            ->get()
            ->map(function ($location) {
                return [
                    'id' => $location->id,
                    'name' => $location->name,
                    'latitude' => (float)$location->latitude,
                    'longitude' => (float)$location->longitude,
                    'city' => $location->city,
                ];
            });

        return response()->json($locations);
    }
}
