<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => Admin::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();


        Gate::define('admin-access', function () {
            $user = auth()->user();
            return $user->role_id == 1;
        });
    }
}
