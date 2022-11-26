<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
   
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

 
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function(User $user){
            if ($user->role_id == 1){
                return true;
            }
        });
        
        Gate::define('update-comment', function(User $user, Comment $comment){
            return $user->id == $comment->author_id
                    ? Response::allow()
                    : Response::deny('Это не ваш комментарий!');
        });
    }
}
