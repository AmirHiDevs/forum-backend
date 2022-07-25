<?php

namespace App\Providers;

use App\Models\Thread;
use App\Models\User;
use App\Repositories\ThreadRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
           return $user->hasRole('Super_Admin') ? true : null;
        });

        Gate::define('manage-thread', function (User $user,Thread $thread) {
            return $user->id == $thread->user_id;
        });
    }
}
