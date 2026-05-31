@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('map.index') }}" class="text-red-100 hover:text-white mb-4 inline-block">
                ← Back to Map
            </a>
            <h1 class="text-4xl font-bold">{{ $location->name }}</h1>
            <p class="text-red-100 mt-2">📍 {{ $location->address }}, {{ $location->city }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Description -->
        @if($location->description)
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">About</h2>
            <p class="text-gray-700 leading-relaxed">{{ $location->description }}</p>
        </div>
        @endif

        <!-- Attractions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">🎢 Attractions ({{ $location->attractions->count() }})</h2>

            @if($location->attractions->count() > 0)
                <div class="grid gap-4">
                    @foreach($location->attractions as $attraction)
                    <a href="{{ route('attractions.show', $attraction) }}" class="block p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-red-300 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900">{{ $attraction->name }}</h3>
                                @if($attraction->type)
                                <p class="text-gray-600 text-sm">Type: {{ $attraction->type }}</p>
                                @endif
                                @if($attraction->description)
                                <p class="text-gray-700 mt-2">{{ Str::limit($attraction->description, 150) }}</p>
                                @endif
                            </div>
                            <div class="text-right ml-4">
                                <div class="text-3xl font-bold text-red-500">⭐</div>
                                <div class="text-sm text-gray-600">{{ $attraction->review_count }} reviews</div>
                            </div>
                        </div>

                        <!-- Ratings -->
                        <div class="mt-3 flex gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Fun:</span>
                                <span class="font-bold text-red-500">{{ $attraction->avg_fun_rating }}/10</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Safety:</span>
                                <span class="font-bold text-green-500">{{ $attraction->avg_safety_rating }}/10</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Value:</span>
                                <span class="font-bold text-blue-500">{{ $attraction->avg_value_rating }}/10</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
            <p class="text-gray-600 text-center py-8">No attractions at this location yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
