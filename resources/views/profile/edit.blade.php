@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Account Settings -->
        <div class="bg-white rounded-lg shadow p-8 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h1>
            <p class="text-gray-600 mb-6">Update your account information</p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-bold text-gray-900 mb-2">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Update Button -->
                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold">
                    Update Profile
                </button>
            </form>

            @if(session('status') === 'profile-updated')
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                Profile updated successfully!
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
