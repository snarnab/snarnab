<?php

namespace App\Providers;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-portfolio', fn (User $user): bool => (bool) $user->getAttribute('is_admin'));
        View::composer('layouts.app', function ($view): void {
            $view->with('schemaSocialLinks', SocialLink::query()->orderBy('sort_order')->pluck('url')->all());
        });
    }
}
