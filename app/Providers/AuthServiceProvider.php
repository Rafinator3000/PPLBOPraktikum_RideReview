<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use App\Models\Attraction;
use App\Policies\AttractionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Review::class => ReviewPolicy::class,
        Attraction::class => AttractionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
