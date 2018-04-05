<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {   
        
    	$this->validate($request, [ // валидация
    		'email'	=>	'required|email|unique:subscriptions'
    	]);

    	$subs = Subscription::add($request->get('email')); // берем из модели Subscription метод add
        $subs->generateToken(); // генрация токена для подтверждения
        
    	 \Mail::to($subs)->send(new SubscribeEmail($subs)); // кому отправить email


    	return redirect()->back()->with('status','Проверьте вашу почту!');
    }

    public function verify($token) // токен проверка
    {
        //dd($token);
    	$subs = Subscription::where('token', $token)->firstOrFail(); // вытаскиваем токен если нет 404 ошибка
    	$subs->token = null;
    	$subs->save();
    	return redirect('/')->with('status', 'Ваша почта подтверждена!');
    }
}