<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerForm() // регистрация формы
    {
    	return view('pages.register');
    }    

    public function register(Request $request) // регистрация формы
    {
    	//dd($request->all()); // все данные формы
    	$this->validate($request, [ // валидация значений формы
    		'name' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required'
    	]);

    	$user = User::add($request->all()); // в User есть метод add
    	$user->generatePassword($request->get('password')); // у экз-ра класса $user вызываем метод 
    	//generatePass перед пароль $request-> all
    	return redirect('/login'); // редирект после создания польз-ля
    }

    public function loginForm()
    {
    	return view('pages.login');
    }

    public function login(Request $request) // Request $request - запрос из формы
    {
    	//return view('pages.login');
    	//dd($request->all()); // все данные формы
    	$this->validate($request, [ // валидация значений формы при входе
    		'email' => 'required|email',
    		'password' => 'required'
    	]);


    	if(Auth::attempt([ // попытка входа если знач-я совп-ют с бд тогда true
    		'email' => $request->get('email'), // передает email  и пароль
    		'password' => $request->get('password') // идем в базу и дел-ем запрос
    	]))
    	{
    		return redirect('/'); // если все ок редирект на главную странице
    	}
    	return redirect()->back()->with('status', 'Неправильный логин или пароль'); // иначе редирект на пред-щую страницу cо значениями

    	//dd($result);

    }

    public function logout() // метод logout выход из профиля
    {
    	Auth::logout(); // выйти 
    	return redirect('/login');
    }
}
