<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Auth\CustomGuard;
use App\Auth\CustomProvider;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::extend('custom', function (Application $app, string $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            return new CustomGuard(
                new CustomProvider($app['config']['auth.providers.' . $config['provider']]['model']),
                $app['request']
            );
        });
    }
}
