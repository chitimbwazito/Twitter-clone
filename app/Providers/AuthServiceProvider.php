<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\idea;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){

        //role

       Gate::define('admin', function(User $user):bool{
            return (bool) $user->is_admin;
        });

        //permissions

        Gate::define('idea.edit', function(User $user, idea $idea):bool{
            return ((bool) $user->is_admin || $user->id === $idea->user_id);
        });

        Gate::define('idea.delete', function(User $user, idea $idea):bool{
            return ((bool) $user->is_admin || $user->id === $idea->user_id);
        });

        Gate::define('users.edit', function(User $user, User $model):bool{
            return ((bool) $user->is_admin || $user->id === $model->id);
        });
        Gate::define('comment.delete', function(User $user, Comment $comment):bool{
            return ((bool) $user->is_admin || $user->id === $comment->user_id);
        });


        // Define any gates or additional authorization logic here
    }
}
