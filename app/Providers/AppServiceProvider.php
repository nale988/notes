<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Note;
use App\Category;
use App\Favorite;
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
            $tags = Tag::with('notes')->where('tag', '<>', '#important')->where('tag', '<>', '#todo')->where('tag', '<>', '#favorite')->orderBy('tag')->get();
            $tags = $tags -> reverse();
            $tags = $tags -> push(Tag::with('notes')->where('tag', '=', '#important')->first());
            $tags = $tags -> push(Tag::with('notes')->where('tag', '=', '#favorite')->first());
            $tags = $tags -> push(Tag::with('notes')->where('tag', '=', '#todo')->first());
            $tags = $tags -> reverse();

            $view->with(['tags' => $tags]);
        });
    }
}
