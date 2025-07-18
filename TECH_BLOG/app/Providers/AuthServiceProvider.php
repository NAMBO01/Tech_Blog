<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->registerPolicies();
        Gate::define('manage-fields', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('manage-categories', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('manage-tags', function ($user) {
            return $user->isAdmin();
        });
    }
}
