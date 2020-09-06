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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view){
            if(Auth::check()){
                $user_id = Auth::id();
                //$notes = Note::where('user_id', $user_id)->orderBy('category_id')->with('category')->get()->groupBy('categories.description');
                $categories = Category::with('notes')->get();
                $view->with(['categories' => $categories]);

                // print_r(json_encode($categories));
                // die;
            }
                // print_r(json_encode($categories));
                // die;
        });
    }
}
