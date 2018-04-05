<?php

namespace App\Http\Controllers\Admin;

use App\Tag;    //подключение модели (namespace)
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all(); // запрос в базу и передаем тэги
        return view('admin.tags.index', ['tags'=>$tags]); // рендерим вид
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create'); // рендерим вид
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // сохранение тэга
    {
        $this->validate($request, [ // валидация по нажатию на кнопку
        'title' => 'required' // обязательное поле

        ]);

        Tag::create($request->all()); // вызов метода create на модели Tag
        return redirect()->route('tags.index'); // редирект обратно

    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // редактирование тэгов
    {
        $category = Tag::find($id);
        return view( 'admin.tags.edit', ['tag'=>$category]);  // вывод вида
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
        $this->validate($request, [ // валидация по нажатию на кнопку
        'title' => 'required' // обязательное поле
        ]);

        $tag =  Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('tags.index'); // редирект обратно
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect()->route('tags.index'); // редирект обратно
    }
}
