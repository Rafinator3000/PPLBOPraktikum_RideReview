@extends('layouts.app')

@section('content')
<div class="reviews-moderation">
    <div class="header">
        <h1>⭐ Moderate Reviews</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-btn">← Back to Dashboard</a>
    </div>

    <div class="reviews-list">
        @forelse($reviews as $review)
        <div class="review-card">
            <div class="review-header">
                <div>
                    <h3>{{ $review->attraction->name }}</h3>
                    <p class="location">{{ $review->attraction->location->name }}</p>
                    <p class="author">By {{ $review->user->name }} • {{ $review->created_at->format('M d, Y') }}</p>
                </div>
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Delete Review</button>
                </form>
            </div>
            <div class="review-content">
                <div class="ratings">
                    <span>Fun: <strong>{{ $review->fun_rating }}/10</strong></span>
                    <span>Safety: <strong>{{ $review->safety_rating }}/10</strong></span>
                    <span>Value: <strong>{{ $review->value_rating }}/10</strong></span>
                </div>
                @if($review->comment)
                <p class="comment">{{ $review->comment }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <p>No reviews to moderate</p>
        </div>
        @endforelse
    </div>

    {{ $reviews->links() }}
</div>

<style>
    .reviews-moderation {
        padding: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #eee;
    }

    .header h1 {
        margin: 0;
        font-size: 2rem;
    }

    .back-btn {
        color: #FF6B6B;
        text-decoration: none;
        font-weight: 600;
    }

    .reviews-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .review-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: box-shadow 0.3s;
    }

    .review-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .review-header h3 {
        margin: 0 0 0.5rem 0;
        color: #2C3E50;
    }

    .location {
        color: #FF6B6B;
        font-weight: 600;
        margin: 0;
    }

    .author {
        color: #999;
        font-size: 0.9rem;
        margin: 0.5rem 0 0 0;
    }

    .btn-delete {
        background: #E74C3C;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-delete:hover {
        background: #c62828;
    }

    .review-content {
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }

    .ratings {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1rem;
        color: #666;
    }

    .ratings strong {
        color: #FF6B6B;
    }

    .comment {
        background: #f5f5f5;
        padding: 1rem;
        border-radius: 8px;
        margin: 0;
        font-style: italic;
        color: #555;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }
</style>
@endsection
