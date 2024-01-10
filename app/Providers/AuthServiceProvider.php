<?php

namespace App\Providers;

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
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Tag' => 'App\Policies\TagPolicy',
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

        Gate::define('create-post', 'App\Policies\PostPolicy@create');
        Gate::define('update-post', 'App\Policies\PostPolicy@update');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');

        Gate::define('create-tag', 'App\Policies\TagPolicy@create');
        Gate::define('update-tag', 'App\Policies\TagPolicy@update');
        Gate::define('delete-tag', 'App\Policies\TagPolicy@delete');
    }

}
