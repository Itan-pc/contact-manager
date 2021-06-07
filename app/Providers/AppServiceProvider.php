<?php

namespace App\Providers;

use App\Repositories\UserContactEloquent;
use App\Repositories\UserContactRepository;
use App\Repositories\UserEloquent;
use App\Repositories\UserRepository;
use App\Services\Auth;
use App\Services\AuthService;
use App\Services\KlaviyoApi;
use App\Services\KlaviyoApiService;
use App\Services\User;
use App\Services\UserContact;
use App\Services\UserContactService;
use App\Services\UserService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth as AuthFacade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthService::class, Auth::class);
        $this->app->bind(UserRepository::class, UserEloquent::class);
        $this->app->bind(StatefulGuard::class, function () {
        	return AuthFacade::guard();
		});

        $this->app->bind(UserService::class, User::class);
        $this->app->bind(UserContactRepository::class, UserContactEloquent::class);
        $this->app->bind(UserContactService::class, UserContact::class);

        $this->app->when(KlaviyoApi::class)
			->needs('$apiLink')
			->give(config('klaviyo.api_link'));

        $this->app->when(KlaviyoApi::class)
			->needs('$apiKey')
			->give(config('klaviyo.private_key'));

        $this->app->bind(KlaviyoApiService::class, KlaviyoApi::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
