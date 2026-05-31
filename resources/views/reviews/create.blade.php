@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-8">
            <a href="{{ route('map.index') }}" class="text-red-500 hover:text-red-600 mb-4 inline-block">
                ← Back to Map
            </a>

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $existingReview ? 'Edit' : 'Write' }} a Review</h1>
                    <p class="text-red-500 font-semibold">{{ $attraction->name }}</p>
                </div>
                @if($existingReview)
                <button type="button" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 font-bold" onclick="confirmDelete()">
                    Delete Review
                </button>
                @endif
            </div>

            @if($existingReview)
            <div class="bg-blue-50 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg mb-6">
                You've already reviewed this attraction. Updating below will modify your previous review.
            </div>
            @endif

            <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
                @csrf
                <input type="hidden" name="attraction_id" value="{{ $attraction->id }}">

                <!-- Fun Rating -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-gray-900 mb-2">
                        🎢 Fun Factor
                    </label>
                    <p class="text-gray-600 text-sm mb-4">How entertaining was this attraction?</p>

                    <div class="flex items-center gap-4">
                        <input
                            type="range"
                            name="fun_rating"
                            min="1"
                            max="10"
                            value="{{ $existingReview->fun_rating ?? 5 }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="fun_rating"
                        >
                        <span class="text-2xl font-bold text-red-500 w-12 text-right" id="funValue">{{ $existingReview->fun_rating ?? 5 }}</span>
                    </div>
                </div>

                <!-- Safety Rating -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-gray-900 mb-2">
                        🛡️ Safety & Comfort
                    </label>
                    <p class="text-gray-600 text-sm mb-4">Did you feel safe and comfortable?</p>

                    <div class="flex items-center gap-4">
                        <input
                            type="range"
                            name="safety_rating"
                            min="1"
                            max="10"
                            value="{{ $existingReview->safety_rating ?? 5 }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="safety_rating"
                        >
                        <span class="text-2xl font-bold text-green-500 w-12 text-right" id="safetyValue">{{ $existingReview->safety_rating ?? 5 }}</span>
                    </div>
                </div>

                <!-- Value Rating -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-gray-900 mb-2">
                        💰 Value for Money
                    </label>
                    <p class="text-gray-600 text-sm mb-4">Was it worth the price?</p>

                    <div class="flex items-center gap-4">
                        <input
                            type="range"
                            name="value_rating"
                            min="1"
                            max="10"
                            value="{{ $existingReview->value_rating ?? 5 }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="value_rating"
                        >
                        <span class="text-2xl font-bold text-blue-500 w-12 text-right" id="valueValue">{{ $existingReview->value_rating ?? 5 }}</span>
                    </div>
                </div>

                <!-- Comment -->
                <div class="mb-8">
                    <label for="comment" class="block text-lg font-bold text-gray-900 mb-2">
                        Comments (Optional)
                    </label>
                    <textarea
                        name="comment"
                        id="comment"
                        rows="5"
                        placeholder="Share details about your experience..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >{{ $existingReview->comment ?? '' }}</textarea>
                </div>

                <!-- Overall Rating -->
                <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-6 rounded-lg mb-8">
                    <p class="text-sm opacity-90">Your Overall Rating</p>
                    <div class="text-4xl font-bold mt-2" id="overallValue">{{ $existingReview ? number_format(($existingReview->fun_rating + $existingReview->safety_rating + $existingReview->value_rating) / 3, 1) : '5.0' }}</div>
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
                    <a href="{{ route('map.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-bold">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold">
                        {{ $existingReview ? 'Update Review' : 'Post Review' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const funInput = document.getElementById('fun_rating');
    const safetyInput = document.getElementById('safety_rating');
    const valueInput = document.getElementById('value_rating');

    function updateRatings() {
        const fun = parseInt(funInput.value);
        const safety = parseInt(safetyInput.value);
        const value = parseInt(valueInput.value);

        document.getElementById('funValue').textContent = fun;
        document.getElementById('safetyValue').textContent = safety;
        document.getElementById('valueValue').textContent = value;

        const overall = ((fun + safety + value) / 3).toFixed(1);
        document.getElementById('overallValue').textContent = overall;
    }

// Only define confirmDelete if there's an existing review
    @if($existingReview)
    function confirmDelete(reviewId) {
        if (confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/reviews/' + reviewId;

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
    @endif

    funInput.addEventListener('input', updateRatings);
    safetyInput.addEventListener('input', updateRatings);
    valueInput.addEventListener('input', updateRatings);
</script>
@endsection
