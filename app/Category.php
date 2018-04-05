<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
	use Sluggable;

    protected $fillable = ['title']; // что нужно сохранять в таблицу
	
   	public function posts(){        // 1 категория может иметь 1 или более постов
   		return $this->hasMany(Post::class);
	}

    public function sluggable()     // перевод в perevod и отсутствие дубликатов, seo френдли
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }	
}
