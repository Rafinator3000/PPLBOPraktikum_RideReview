<?php
namespace App\Policies;

use App\Models\Admin;
use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    // User can update their own review
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    // User can delete their own review, or admin can delete any
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    // Admin can delete any review
    public function adminDelete(?Admin $admin, Review $review): bool
    {
        return $admin !== null;
    }
}
