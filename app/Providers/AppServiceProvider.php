<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Input\Input;

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
            $view->with('routeName', Route::current()->getName());
            $view->with('authUser', Auth::user());
            if(Auth::user()) {
                $directory = 'user-'.Auth::user()->id.'-files';
                $view->with('directory', $directory);
                $view->with('files', File::getAllFilesInDirectory($directory));
            }
        });
    }
}
