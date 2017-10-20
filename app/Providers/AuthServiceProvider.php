<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(function($user, $ability){
            if($user->isAdmin()) {
                return true;
            }
        });

        if(!app()->runningInConsole() || app()->runningUnitTests()) {
            $permission = Permission::whereNotNull('resource_name')->get();
            foreach ($permission as $p) {
                \Gate::define("{$p->name}/{$p->resource_name}", function ($user) use ($p) {
                    return $user->hasRole($p->roles);
                });
            }
        }
    }
}
