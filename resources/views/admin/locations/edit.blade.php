@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-8">
            <a href="{{ route('admin.locations.show', $location) }}" class="text-red-500 hover:text-red-600 mb-4 inline-block">
                ← Back to {{ $location->name }}
            </a>

            <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Location</h1>

            <form action="{{ route('admin.locations.update', $location) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Location Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $location->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-bold text-gray-900 mb-2">Address *</label>
                    <input
                        type="text"
                        id="address"
                        name="address"
                        value="{{ old('address', $location->address) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div class="mb-6">
                    <label for="city" class="block text-sm font-bold text-gray-900 mb-2">City *</label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        value="{{ old('city', $location->city) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div class="mb-6">
                    <label for="state" class="block text-sm font-bold text-gray-900 mb-2">State/Province</label>
                    <input
                        type="text"
                        id="state"
                        name="state"
                        value="{{ old('state', $location->state) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                    @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country -->
                <div class="mb-6">
                    <label for="country" class="block text-sm font-bold text-gray-900 mb-2">Country *</label>
                    <input
                        type="text"
                        id="country"
                        name="country"
                        value="{{ old('country', $location->country) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('country')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latitude -->
                <div class="mb-6">
                    <label for="latitude" class="block text-sm font-bold text-gray-900 mb-2">Latitude *</label>
                    <input
                        type="number"
                        id="latitude"
                        name="latitude"
                        step="0.000001"
                        value="{{ old('latitude', $location->latitude) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('latitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Longitude -->
                <div class="mb-6">
                    <label for="longitude" class="block text-sm font-bold text-gray-900 mb-2">Longitude *</label>
                    <input
                        type="number"
                        id="longitude"
                        name="longitude"
                        step="0.000001"
                        value="{{ old('longitude', $location->longitude) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    @error('longitude')
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
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >{{ old('description', $location->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Verified -->
                <div class="mb-6">
                    <label for="verified" class="flex items-center">
                        <input
                            type="checkbox"
                            id="verified"
                            name="verified"
                            value="1"
                            {{ old('verified', $location->verified) ? 'checked' : '' }}
                            class="rounded"
                        >
                        <span class="ml-3 text-sm font-bold text-gray-900">Mark as Verified</span>
                    </label>
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
                        Update Location
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
