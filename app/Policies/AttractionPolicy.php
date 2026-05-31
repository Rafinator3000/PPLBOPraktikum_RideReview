<?php
namespace App\Policies;

use App\Models\Admin;
use App\Models\Attraction;

class AttractionPolicy
{
    // Only admins can create attractions
    public function create(?Admin $admin): bool
    {
        return $admin !== null && $admin->hasRole('admin');
    }

    // Only admins can update
    public function update(?Admin $admin, Attraction $attraction): bool
    {
        return $admin !== null && $admin->hasRole('admin');
    }

    // Only admins can delete
    public function delete(?Admin $admin, Attraction $attraction): bool
    {
        return $admin !== null && $admin->hasRole('admin');
    }
}
