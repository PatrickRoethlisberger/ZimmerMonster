<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // User blade directives

        Blade::if('teammember', function () {
            return auth()->check() && auth()->user()->team;
        });

        Blade::if('client', function () {
            return auth()->check() && !auth()->user()->team;
        });

        // Team blade directives

        Blade::if('adminMember', function () {
            return auth()->check() && auth()->user()->team && auth()->user()->team->type == 'admin';
        });

        Blade::if('touristAssociationMember', function () {
            return auth()->check() && auth()->user()->team && auth()->user()->team->type == 'tourist_association';
        });

        Blade::if('hotelMember', function () {
            return auth()->check() && auth()->user()->team && auth()->user()->team->type == 'hotel';
        });
    }
}
