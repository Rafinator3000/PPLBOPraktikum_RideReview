<!-- Reviews List -->
<div class="space-y-4">
    @if($attraction->reviews->count() > 0)
        @foreach($attraction->reviews as $review)
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900">{{ $review->user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                </div>
                @auth
                    @if(auth()->id() === $review->user_id)
                    <div class="flex gap-2">
                        <a href="{{ route('reviews.edit', $review) }}" class="text-blue-600 hover:text-blue-700 text-sm font-bold">Edit</a>
                        <button onclick="confirmDelete({{ $review->id }})" class="text-red-600 hover:text-red-700 text-sm font-bold">Delete</button>
                    </div>
                    @endif
                @endauth
            </div>

            <div class="flex gap-3 mt-2 text-sm">
                <span>Fun: <strong class="text-red-500">{{ $review->fun_rating }}/10</strong></span>
                <span>Safety: <strong class="text-green-500">{{ $review->safety_rating }}/10</strong></span>
                <span>Value: <strong class="text-blue-500">{{ $review->value_rating }}/10</strong></span>
            </div>

            @if($review->comment)
            <p class="mt-3 text-gray-700">"{{ $review->comment }}"</p>
            @endif
        </div>
        @endforeach
    @else
    <p class="text-gray-600 text-center py-8">No reviews yet. Be the first to review!</p>
    @endif
</div>

<script>
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
</script>
