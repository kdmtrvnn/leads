<?php

namespace App\Providers;

use App\Repositories\Interfaces\LeadRepositoryInterface;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share('user', fn (Request $request) => $request->user()
            ? $request->user()->only('id', 'name', 'email')
            : null
        );
    }
}
