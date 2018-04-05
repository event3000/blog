<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function index()
    {	
    	$user = Auth::user(); // дает юзера который залогинен в данный момент
    	// dd($user); // проверка
    	return view('pages.profile', ['user' => $user]);
    }

    public function store(Request $request) // метод store приним-ет данные из формы Request $request
    {
    	//dd($request->all());
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore(Auth::user()->id), // валидация если уникальный email
            ],
    		'avatar' => 'nullable|image'
    	]);

    	//echo "все ок"; // проверка
    	$user = Auth::user();
    	$user->edit($request->all());
    	$user->generatePassword($request->get('password'));
    	$user->uploadAvatar($request->file('avatar'));

    	return redirect()->back()->with('status', 'Профиль успешно обновлен'); // флеш сообщение
    }
}
