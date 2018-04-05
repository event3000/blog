<?php

namespace App\Http\Controllers;
use App\Category; // модуль Category
use App\Tag; // модуль Tag
use App\Post; // подкл модель Post
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	//echo "проверка работы";
        // dd(\Auth::check()); // если юзер залогинен будет true
    	$posts = Post::paginate(5); // вместо all(), вытягиваем 2 поста paginate(2) из БД
        
         // в app/appServProvider.php  остальное view composer что бы ссылки работали в  сайбаре


    	return view('pages.index')->with('posts', $posts);  // что передаем в вид 
          
    }

    public function show($slug) // вывод поста
    {
    	//dd($slug); проверка
    	$post = Post::where('slug', $slug)->firstOrFail(); // firstOrFail вытащим элемент либо ошибку 404
    	//dd($post->id); // выдаст 404 стр - такой страницы нет
    	return view('pages.show', compact('post')); // вид и передаем compact('post')
    }

    public function tag($slug) // теги
    {
        $tag = Tag::where('slug', $slug)->firstOrFail(); // вытаскиваем тэг из базы
        $posts = $tag->posts()->paginate(5); // берем все посты от текущего тега с пагинацией
        return view('pages.list', ['posts' => $posts]); // вывод вида
    }  
    
    public function category($slug) // категория
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(5); // берем все посты от текущего тега
        return view('pages.list', ['posts' => $posts]); // вывод вида list с параметрами
    } 

}
