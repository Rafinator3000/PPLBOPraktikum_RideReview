@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-500 via-pink-500 to-orange-500">
    <!-- Navigation -->
    <nav class="bg-black bg-opacity-20 backdrop-blur-md py-4 px-4 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold">🎢 RideReview</div>
            <div class="flex gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-white text-red-500 rounded-lg font-bold hover:bg-gray-100 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-red-500 rounded-lg font-bold hover:bg-gray-100 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-red-500 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left Side -->
            <div class="text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Discover the Best Attractions
                </h1>
                <p class="text-xl text-white text-opacity-90 mb-4">
                    Read honest reviews from real visitors. Rate attractions on fun factor, safety, and value.
                </p>
                <p class="text-lg text-white text-opacity-80 mb-8">
                    Find your next favorite ride with detailed ratings and community feedback.
                </p>

                <div class="flex gap-4">
                    @guest
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-red-500 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                        Get Started
                    </a>
                    <a href="{{ route('map.index') }}" class="px-8 py-4 border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white hover:text-red-500 transition">
                        Explore Map
                    </a>
                    @else
                    <a href="{{ route('map.index') }}" class="px-8 py-4 bg-white text-red-500 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                        View Map
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white hover:text-red-500 transition">
                        Dashboard
                    </a>
                    @endguest
                </div>
            </div>

            <!-- Right Side - Stats -->
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 text-white border border-white border-opacity-20">
                    <div class="text-4xl font-bold mb-2">3</div>
                    <div class="text-lg opacity-90">Locations</div>
                    <div class="text-sm opacity-70 mt-2">Major theme parks</div>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 text-white border border-white border-opacity-20">
                    <div class="text-4xl font-bold mb-2">6+</div>
                    <div class="text-lg opacity-90">Attractions</div>
                    <div class="text-sm opacity-70 mt-2">Available to review</div>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 text-white border border-white border-opacity-20">
                    <div class="text-4xl font-bold mb-2">100%</div>
                    <div class="text-lg opacity-90">Honest Reviews</div>
                    <div class="text-sm opacity-70 mt-2">From real visitors</div>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 text-white border border-white border-opacity-20">
                    <div class="text-4xl font-bold mb-2">⭐</div>
                    <div class="text-lg opacity-90">Community Driven</div>
                    <div class="text-sm opacity-70 mt-2">By you, for everyone</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-black bg-opacity-30 backdrop-blur-md py-20 px-4 mt-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-white mb-12 text-center">How It Works</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 border border-white border-opacity-20 hover:bg-opacity-20 transition">
                    <div class="text-5xl mb-4">🗺️</div>
                    <h3 class="text-2xl font-bold text-white mb-3">Browse Locations</h3>
                    <p class="text-white opacity-80">
                        Explore attractions on an interactive map. Click any location to see all available rides.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 border border-white border-opacity-20 hover:bg-opacity-20 transition">
                    <div class="text-5xl mb-4">⭐</div>
                    <h3 class="text-2xl font-bold text-white mb-3">Read Reviews</h3>
                    <p class="text-white opacity-80">
                        See what others think. Read detailed reviews with ratings on fun, safety, and value.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-8 border border-white border-opacity-20 hover:bg-opacity-20 transition">
                    <div class="text-5xl mb-4">✍️</div>
                    <h3 class="text-2xl font-bold text-white mb-3">Share Your Experience</h3>
                    <p class="text-white opacity-80">
                        Write reviews and rate attractions. Help other visitors make informed decisions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-6xl mx-auto px-4 py-20">
        <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-lg p-12 text-center border border-white border-opacity-20">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Explore?</h2>
            <p class="text-xl text-white opacity-90 mb-8">
                Start discovering the best attractions in your area today.
            </p>

            @guest
            <div class="flex gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-red-500 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                    Create Account
                </a>
                <a href="{{ route('map.index') }}" class="px-8 py-4 border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white hover:text-red-500 transition">
                    Browse as Guest
                </a>
            </div>
            @else
            <a href="{{ route('map.index') }}" class="inline-block px-8 py-4 bg-white text-red-500 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                Go to Map
            </a>
            @endguest
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-black bg-opacity-50 text-white py-8 px-4 mt-20 border-t border-white border-opacity-10">
        <div class="max-w-6xl mx-auto text-center">
            <p class="opacity-80">© 2024 RideReview. All rights reserved.</p>
            <p class="opacity-60 text-sm mt-2">
                Made with ❤️ for theme park enthusiasts
            </p>
        </div>
    </div>
</div>
@endsection
