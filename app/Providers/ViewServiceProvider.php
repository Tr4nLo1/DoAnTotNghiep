<?php
 
namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\DanhmucComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
       View::composer('header',DanhmucComposer::class);
       View::composer('cart',CartComposer::class);
       View::composer('home2',DanhmucComposer::class);
       View::composer('login',DanhmucComposer::class);
       View::composer('registrationuser',DanhmucComposer::class);
    }
}