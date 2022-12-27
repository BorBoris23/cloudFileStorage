<?php

namespace App\Providers;

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            if(!empty(Route::current())) {
                $view->with('routeName', Route::current()->getName());
            }
//            $view->with('routeName', Route::current()->getName());
            $view->with('authUser', Auth::user());
        });
//        View::composer('searchPanel', function ($view) {
//            $view->with('result', Route::post('/search', [SearchController::class, 'search']));
//        });
    }
}
