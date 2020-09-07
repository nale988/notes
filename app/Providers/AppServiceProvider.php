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
                
                $ismobile = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i', $_SERVER['HTTP_USER_AGENT']) ? 1 : 0;

                $view->with(['categories' => $categories, 'ismobile' => $ismobile]);
            }
        });
    }
}
