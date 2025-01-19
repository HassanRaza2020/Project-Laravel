<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VerificationService;
use App\Repositories\VerificationRepository;
use App\Services\UserService;
use App\Repositories\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        
        // Bind the VerificationService
        $this->app->bind(VerificationService::class, function ($app) {
            return new VerificationService($app->make(VerificationRepository::class));
        });


        $this->app->bind(UserService::class, function($app){
            return new UserService($app->make(UserRepository::class));
        });//user service added here
        
    }

    

    public function boot()
    {
        //
    }
}
