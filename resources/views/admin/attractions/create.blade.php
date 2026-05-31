@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-8">
            <a href="{{ route('admin.locations.show', $location) }}" class="text-red-500 hover:text-red-600 mb-4 inline-block">
                ← Back to {{ $location->name }}
            </a>

            <h1 class="text-3xl font-bold text-gray-900 mb-6">Add New Attraction</h1>
            <p class="text-gray-600 mb-6">Adding attraction to: <strong>{{ $location->name }}</strong></p>

            <form action="{{ route('admin.attractions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="location_id" value="{{ $location->id }}">

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Attraction Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g., Space Mountain, Roller Coaster"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div class="mb-6">
                    <label for="type" class="block text-sm font-bold text-gray-900 mb-2">Type *</label>
                    <input
                        type="text"
                        id="type"
                        name="type"
                        value="{{ old('type') }}"
                        placeholder="e.g., Roller Coaster, Water Ride, Dark Ride"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-900 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Describe the attraction..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Errors -->
                @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('admin.locations.show', $location) }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-bold">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold">
                        Add Attraction
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
