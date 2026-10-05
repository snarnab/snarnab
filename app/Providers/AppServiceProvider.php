<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
            $socialLinks = SocialLink::query()->orderBy('sort_order')->get();
            $headerContactSettings = SiteSetting::query()
                ->whereIn('key', ['contact_email', 'phone', 'office'])
                ->get()
                ->keyBy('key');

            $view->with([
                'schemaSocialLinks' => $socialLinks->pluck('url')->all(),
                'headerSocialLinks' => $socialLinks->whereIn('platform', ['LinkedIn', 'GitHub', 'Facebook', 'YouTube']),
                'headerContactSettings' => $headerContactSettings,
            ]);
        });
    }
}
