<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


// c 1 тэга вытаскиваем все статьи кото привзяаны
class Tag extends Model
{
	use Sluggable;
    // у статьи есть связь с тегами (связь многое ко многим)

    protected $fillable = ['title']; // что нужно сохранять в таблицу (иначе ошибка с множ-ым добавлением)
    
	public function posts(){
		return $this->belongsToMany(
			Post::class,
			'post_tags',
			'tag_id',
			'post_id'

		);
	}


	// перевод в perevod и отсутствие дубликатов, seo френдли
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }	
}
