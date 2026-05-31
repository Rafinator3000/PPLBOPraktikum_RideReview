@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-8">
            <a href="{{ route('attractions.show', $review->attraction) }}" class="text-red-500 hover:text-red-600 mb-4 inline-block">
                ← Back to {{ $review->attraction->name }}
            </a>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Your Review</h1>
            <p class="text-red-500 font-semibold mb-6">{{ $review->attraction->name }}</p>

            <form action="{{ route('reviews.update', $review) }}" method="POST" id="reviewForm">
                @csrf
                @method('PUT')

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
                            value="{{ $review->fun_rating }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="fun_rating"
                        >
                        <span class="text-2xl font-bold text-red-500 w-12 text-right" id="funValue">{{ $review->fun_rating }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>😞 Bad</span>
                        <span>😍 Great</span>
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
                            value="{{ $review->safety_rating }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="safety_rating"
                        >
                        <span class="text-2xl font-bold text-green-500 w-12 text-right" id="safetyValue">{{ $review->safety_rating }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>😰 Unsafe</span>
                        <span>😌 Safe</span>
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
                            value="{{ $review->value_rating }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                            id="value_rating"
                        >
                        <span class="text-2xl font-bold text-blue-500 w-12 text-right" id="valueValue">{{ $review->value_rating }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>😠 Bad Value</span>
                        <span>😄 Great Value</span>
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
                    >{{ $review->comment }}</textarea>
                    <p class="text-sm text-gray-500 mt-2"><span id="charCount">{{ strlen($review->comment) }}</span>/1000 characters</p>
                </div>

                <!-- Overall Rating -->
                <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-6 rounded-lg mb-8">
                    <p class="text-sm opacity-90">Your Overall Rating</p>
                    <div class="text-4xl font-bold mt-2" id="overallValue">{{ number_format(($review->fun_rating + $review->safety_rating + $review->value_rating) / 3, 1) }}</div>
                    <div class="text-2xl mt-2" id="overallStars">⭐⭐⭐⭐⭐</div>
                </div>

                <!-- Form Errors -->
                @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <p class="font-bold mb-2">Please fix these errors:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('attractions.show', $review->attraction) }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-bold">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold">
                        Update Review
                    </button>
                    <button type="button" class="ml-auto px-6 py-3 bg-red-700 text-white rounded-lg hover:bg-red-800 font-bold" onclick="confirmDelete()">
                        Delete Review
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
    const commentInput = document.getElementById('comment');

    function updateRatings() {
        const fun = parseInt(funInput.value);
        const safety = parseInt(safetyInput.value);
        const value = parseInt(valueInput.value);

        document.getElementById('funValue').textContent = fun;
        document.getElementById('safetyValue').textContent = safety;
        document.getElementById('valueValue').textContent = value;

        const overall = ((fun + safety + value) / 3).toFixed(1);
        document.getElementById('overallValue').textContent = overall;

        const stars = Math.round(overall);
        let starString = '';
        for (let i = 0; i < 5; i++) {
            starString += i < stars ? '⭐' : '☆';
        }
        document.getElementById('overallStars').textContent = starString;
    }

    function updateCharCount() {
        document.getElementById('charCount').textContent = commentInput.value.length;
    }

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('reviews.destroy', $review) }}';

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

    funInput.addEventListener('input', updateRatings);
    safetyInput.addEventListener('input', updateRatings);
    valueInput.addEventListener('input', updateRatings);
    commentInput.addEventListener('input', updateCharCount);

    updateRatings();
    updateCharCount();
</script>
@endsection
