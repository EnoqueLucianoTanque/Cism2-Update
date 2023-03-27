<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('isAdmin', function($user) {
            return $user->r_id==9? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });

        Gate::define('pre_award_manager', function($user) {
            return $user->r_id ==2 ? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('scientific_director', function($user) {
            return $user->r_id ==12 ? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });

        Gate::define('isInvestigator', function($user) {
            return $user->r_id == 1? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });

        Gate::define('unidadeReguladora', function($user) {
            return $user->r_id == 4? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('scientificCoordinator', function($user) {
            return $user->r_id == 5? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('ethicalCoordinator', function($user) {
            return $user->r_id == 6? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('studyTeam', function($user) {
            return $user->r_id == 7? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('management', function($user) {
            return $user->r_id == 8? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });

        Gate::define('grantManager', function($user) {
            return $user->r_id == 3? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });
        Gate::define('studyGroup', function($user) {
            return $user->r_id == 11? Response::allow():Response::deny('Não tem autorização para aceder a esta página');
        });

    }
}
