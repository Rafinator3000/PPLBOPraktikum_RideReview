@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
                        <p class="text-gray-600 mt-2">Ready to explore some attractions?</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Map Link -->
                    <a href="{{ route('map.index') }}" class="block group">
                        <div class="bg-gradient-to-br from-red-500 to-pink-500 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                            <div class="text-4xl mb-3">🗺️</div>
                            <h2 class="text-2xl font-bold mb-2">Explore Map</h2>
                            <p class="text-red-100">Browse attractions and write reviews</p>
                        </div>
                    </a>

                    <!-- Profile Link -->
                    <a href="{{ route('profile.edit') }}" class="block group">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                            <div class="text-4xl mb-3">👤</div>
                            <h2 class="text-2xl font-bold mb-2">My Profile</h2>
                            <p class="text-blue-100">Update your account information</p>
                        </div>
                    </a>
                </div>

                <!-- Stats -->
                {{-- <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600">Reviews</div>
                            <p class="text-gray-600 text-sm">You've written reviews</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-teal-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">Attractions</div>
                            <p class="text-gray-600 text-sm">Available to review</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">Locations</div>
                            <p class="text-gray-600 text-sm">To explore</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
