<?php

namespace App\Providers;

use App\Post;
use App\Tag;
use App\Comment;
use App\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    public function boot() // метод boot это внедрение до вывода вида сайбара (когда все библы загружены)
    {   // при загрузке сайдбара - должна работать данная функция - он принимает вид
        view()->composer('pages._sidebar', function($view){
            $view->with('popularPosts', Post::getPopularPosts());
            $view->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get());
            $view->with('recentPosts', Post::orderBy('date', 'desc')->take(4)->get());
            $view->with('categories', Category::all());
            $view->with('tags', Tag::all());
        });

        // админка сайдбар (для переменных)
         view()->composer('admin._sidebar', function($view){
            $view->with('newCommentsCount', Comment::where('status', 0)->count() );
        });

 
     
    }

    public function register()
    {
        //
    }
}
