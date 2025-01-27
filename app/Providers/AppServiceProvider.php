<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VerificationService;
use App\Repositories\VerificationRepository;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Services\ForgetPasswordService;
use App\Repositories\ForgetPasswordRepository;
use App\Models\User;
use App\Models\ForgetPassword;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {


        $this->app->bind('ForgetPasswordRepository', function ($app) {
            return new ForgetPasswordRepository($app->make(\App\Models\User::class),$app->make(\App\Models\ForgetPassword::class));
        });

        $this->app->bind(VerificationService::class, function ($app) {
            return new VerificationService($app->make(VerificationRepository::class), $app->make(UserRepository::class) );
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        // $this->app->bind(ForgetPasswordService::class, function ($app) {
        //     return new ForgetPasswordService($app->make(ForgetPasswordRepository::class));
        // });

        // $this->app->bind(ForgetPasswordService::class, function ($app) {
        //     return new ForgetPasswordRepository(
        //         $app->make(\App\Models\User::class),
        //         $app->make(\App\Models\ForgetPassword::class)
        //     );
        // });
        



    }

    public function boot()
    {
        //
    }
}
