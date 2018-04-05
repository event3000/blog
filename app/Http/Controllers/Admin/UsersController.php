<?php

namespace App\Http\Controllers\Admin; 

use App\User; // подключаем модель User (через прост-во имен)
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]); // передача ['users' => $users] в наш вид
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //dd($request->all()); // получаем данные после заполнения формы
        $this->validate($request, [ // делаем валидацию для формы
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' => 'nullable|image'

        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('users.index');
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user = User::find($id); // выборка из базы и передача в вид
        return view('admin.users.edit', compact('user') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore($user->id), // валидация если уникальный email
            ],
            'avatar' => 'nullable|image'
        ]);

        $user->edit($request->all()); // изменяем все данные юзера на те что из запроса
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar')); // изменяем все данные юзера на те что из запроса

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // удаляет картинку и юзера
    {
        User::find($id)->remove();
        return redirect()->route('users.index');
    }  




}
