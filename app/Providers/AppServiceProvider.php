<?php

namespace App\Providers;

use App\Models\Status;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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

        if (\App::environment('production')) {
            Inertia::share('statuses', Status::get());
        }
    }
}
