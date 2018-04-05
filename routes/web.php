<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ПУТЬ --- ДАЛЕЕ КОНТРОЛЛЕР С ЭКШЕНОМ
Route::get('/', 'HomeController@index'); // Главнвя, контроллер с экшеном(index)

Route::get('/post/{slug}', 'HomeController@show')->name('post.show'); // отд-ый пост
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show'); //  теги
Route::get('/category/{slug}', 'HomeController@category')->name('category.show'); // категории
Route::post('/subscribe', 'SubsController@subscribe'); // подписка
Route::get('/verify/{token}', 'SubsController@verify'); // проверка подписка
Route::get('/about', 'AboutController@index'); // about
Route::get('/shop', 'ShopController@index'); // shop (страница скрыта пока из меню)

Route::group(['middleware'	=>	'auth'], function(){ // middleware группа - для auth юзеров
	Route::get('/profile', 'ProfileController@index'); 
	Route::post('/profile', 'ProfileController@store');
	Route::get('/logout', 'AuthController@logout'); // разлогивание
	Route::post('/comment', 'CommentsController@store'); // комменты
});

Route::group(['middleware'	=>	'guest'], function(){ // middleware группа - гостей
	Route::get('/register', 'AuthController@registerForm'); // регистрация юзеров get
	Route::post('/register', 'AuthController@register'); //регистрация юзеров post (сюда пр данные формы)
	Route::get('/login','AuthController@loginForm')->name('login');
	Route::post('/login', 'AuthController@login');
});

// АДМИНКА - ДОСТУП ЧЕРЕЗ MIDDLEWARE ТОЛЬКО АДМИНУ
Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware'	=>	'admin'], function(){
	Route::get('/', 'DashboardController@index'); // по данному адресу отраб-ет контроллер и экшен
	Route::resource('/categories', 'CategoriesController'); //  далее в контр CategoriesController
	Route::resource('/tags', 'TagsController'); 
	Route::resource('/users', 'UsersController'); 
	Route::resource('/posts', 'PostsController'); 
	Route::get('/comments', 'CommentsController@index');
	Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
	Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
	Route::resource('/subscribers', 'SubscribersController');

});


