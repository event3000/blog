<?php

namespace App;

use Carbon\Carbon; //  LRV работа с датами
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; 

class Post extends Model
{
	use Sluggable; 	// у статьи есть категория
	const IS_DRAFT = 0;
	const IS_PUBLIC = 1;

	protected $fillable = ['title', 'content', 'date', 'description']; // массовое присвоение полей
    // эти поля в бд

	public function category()
    {
		return $this->belongsTo(Category::class); // принадл-т одному 
	}
	
	public function author(){ // у статьи есть автор (один ко многим)
		return $this->belongsTo(User::class, 'user_id'); //  принадл-т одному автору
	}

    public function comments() // связь с комментами
    {
        return $this->hasMany(Comment::class);
    }

	public function tags(){ // у статьи есть связь с тегами (связь многое ко многим)
		return $this->belongsToMany(
			Tag::class,
			'post_tags',
			'post_id',
			'tag_id'
		);
	}
	
    public function sluggable() // перевод в perevod и отсутствие дубликатов, seo френдли
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


	public static function add($fields) // МЕТОД добавить пост
    {
    	// созд нов экз-р модели 
    	$post = new static;
    	// заполн-ем данными
    	$post->fill($fields);
    	$post->user_id = 1;
    	$post -> save();

    	return $post;
    }

	public function edit($fields) // МЕТОД редакт-я поста
    {
    	$this->fill($fields); //заполняем поля
    	$this -> save();
    }

	public function remove()   // МЕТОД удаления поста
    {
        $this->removeImage(); // вызов метода removeImage кот сделали (2местах)
    	$this->delete();
    }

    public function removeImage() // создаем метод тк он исп-ся в 2х местах
    {
        if($this->image != null) // если картинка
        {
            Storage::delete('uploads/' . $this->image); // удаление предид. картинки 
        }
        
    }

	public function uploadImage($image)  // МЕТОД загрузки картинки
    {
    	if ( $image == null ) { return; }

        $this->removeImage(); // вызов метода removeImage кот сделали (2местах)

    	$filename = str_random(10) . '.' . $image->extension();	// генерация назв-я файл будет вроде	 gejmemtiijmx.jpg
    	$image->storeAs('uploads', $filename); // сохр-ие в папку uploads
    	$this->image = $filename; // переброс в поле images
    	$this -> save(); // сохранение
    }


    public function getImage() // метод для вывода картинки
    {	
    	if ($this->image == null)
    	{
    		return '/img/no-image.png';
    	} 
    	return '/uploads/' . $this->image;
    }



    public function setCategory($id)    // привязка категории 
    {
    	if ( $id == null ) { return; }	
    	$this->category_id = $id;
    	$this->save();  
    }



    public function setTags($ids) // привязка тэгов 
    {
    	if ( $ids == null ) { return; }
    	$this->tags()->sync($ids); // синхранизация статьи с тэгами   	
    }


	public function setDraft() 	// статус записи - черновик 
    {
    	$this->status = Post::IS_DRAFT;
    	$this->save();     	
    }
 
	public function setPublic()    // статус записи - публичный 
    {
    	$this->status = Post::IS_PUBLIC;
    	$this->save();     	
    }

	public function toggleStatus($value)    // переключатель
    {
    	if ( $value == null ) 
		{
			return $this->setDraft();	
		}
	
		return $this->setPublic();	
    }

   	public function setFeatured() 	// статус записи - featured рекоменд-ые
    {
    	$this->is_featured = 1;
    	$this->save();     	
    }
 
	public function setStandart()    // статус записи - stand статьи
    {
    	$this->is_featured = 0;
    	$this->save();     	
    }

	public function toggleFeatured($value)    // переключатель
    {
    	if ( $value == null ) 
		{
			return $this->setStandart();	
		}
	
			return $this->setFeatured();	
    }


    public function setDateAttribute($value) // Сеттер/Мутатор
    {
        $date = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');// преобр-е даты с пом 
        // Carbon пакета
        //dd($date); // проверка выводв даты
        $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value) // Геттер/Акцессор для едита
    {
        //dd($value);
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        return $date;
    }

    public function getCategoryTitle()
    {
        // if($this->category != null)
        // {
        //     return $this->category->title;
        // }   

        // return 'нет категории';

        return ($this->category != null) // укороч вар-т
                ?   $this->category->title
                :   'нет категории';
    }

    public function getTagsTitles()
    {
        //dd($this->tags->pluck('title')->all());
        //dd(implode(', ', $this->tags->pluck('title')->all()   )); // массисв привести к строке

        return (!$this->tags->isEmpty()) // укороч вар-т
        ?   implode(', ', $this->tags->pluck('title')->all())
        :   'нет тегов';
    }  

    public function getCategoryID() 
        {
         return $this->category != null ? $this->category->id : null;
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }

    public function hasPrevious() // пред-ий пост
    {
        return self::where('id', '<', $this->id)->max('id'); // id меньше где текущ id берем макс знач
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious(); //ID поста
        return self::find($postID); // запрос в БД
    }

    public function hasNext() // след пост
    {
        return self::where('id', '>', $this->id)->min('id'); // id больше где текущ id берем мин знач
    }

    public function getNext()
    {
        $postID = $this->hasNext(); //ID поста
        return self::find($postID); // запрос в БД
    }

    public function related() // вывод похожих постов
    {
        return self::all()->except($this->id); // выводим все посты кроме текущего
    }

    public function hasCategory() // post имеет категорию
    {
        return $this->category != null ? true : false; // если есть у поста есть кат-рия тру, иначе фолс
    }

    public static function getPopularPosts() // статичный метод кот исп-ся в провайдере
    {
        return self::orderBy('views','desc')->take(3)->get();
    }

    public function getComments() // показ всех  комментов только с id status 1
    {
        return $this->comments()->where('status', 1)->get();
    } 




}

