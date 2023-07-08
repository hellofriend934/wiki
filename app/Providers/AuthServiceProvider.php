<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Block;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('user-block', function (User $user) {
            if ($user->block == true && $expire = Block::query()->where('user_id', $user->id)->value('expire'))
            {
                $now = Carbon::now();
                if ($now >= $expire)
                {
                    return  true;
                }return  false;
            }else{
                return true;
            }
        });
    }
}
