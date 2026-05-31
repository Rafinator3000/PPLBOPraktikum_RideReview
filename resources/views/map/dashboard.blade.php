@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>

                <div class="space-y-4">
                    <a href="{{ route('map.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50">
                        <h3 class="font-bold text-lg">🗺️ View Map</h3>
                        <p class="text-gray-600">Explore attractions and write reviews</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="block p-4 border rounded-lg hover:bg-gray-50">
                        <h3 class="font-bold text-lg">👤 My Profile</h3>
                        <p class="text-gray-600">Update your account</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
