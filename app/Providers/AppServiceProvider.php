<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Note;
use App\Category;
use App\Tag;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('*', function ($view){
            $tags = Tag::with('notes')->get()->sortBy('tag');
            $view->with(['tags' => $tags]);
        });
    }
}
