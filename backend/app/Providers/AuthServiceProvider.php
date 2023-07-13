<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Author;
use App\Models\User;
use App\Policies\AuthorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Author::class => AuthorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

//        Gate::define('update-author', function (User $user) {
//            return $user->hasPermission('update-author');
//        });
    }
}
