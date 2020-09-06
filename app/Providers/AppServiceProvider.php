<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Note;
use App\Category;

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

    public function boot()
    {
        view()->composer('*', function ($view){
            if(Auth::check()){
                $user_id = Auth::id();
                $categories = Category::with('notes')->get()->sortBy('description');
                $view->with(['categories' => $categories]);
            }
        });
    }
}
