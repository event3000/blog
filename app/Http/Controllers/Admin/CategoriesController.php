<?php

namespace App\Http\Controllers\Admin;

use App\Category; // подкл модель Category
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // подкл  контроллер  Controller

class CategoriesController extends Controller
{
    public function index()
    {
    	//dd('2'); // проверка

    	$categories = Category::all(); // вытяжка всех категорий из нашей таблицы

    	return view( 'admin.categories.index', ['categories' => $categories] );   
    }

    public function create()
    {
		return view( 'admin.categories.create' );  // вывод формы
    }

    public function store(Request $request) 
    {
    	$this->validate($request, [ // валидация по нажатию на кнопку
    		'title' => 'required' // обязательное поле
    		// 'description' => 'required' // обязательное поле
    		// 'email' => 'email|unique:users' // обязательное поле и уникальное в таблице users
    	]);
    	//dd($request->get('title')); // получение тайтла
    	Category::create($request->all()); // создаем категорию
    	return redirect()->route('categories.index'); // редирект обратно

    	// create/find модели нет (это laravel model)
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view( 'admin.categories.edit', ['category'=>$category]);  // вывод вида
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [ // валидация по нажатию на кнопку
            'title' => 'required' // обязательное поле
        ]);

        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index'); // редирект обратно
    }

    public function destroy($id)
       {
           //dd($id);
            Category::find($id)->delete();
            return redirect()->route('categories.index'); // редирект обратно
       }   

}
