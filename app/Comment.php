<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{	
 	public function posts()  		// связь комментов с постом
    {    
        return $this->belongsTo(Post::class); // 1 пост может иметь много комментов 
        //но 1 коммент принаддежит 1 посту
    }

 	public function author()     // связь комментов с автором
 	{	
        return $this->belongsTo(User::class, 'user_id'); // 1 автор может написать много комментов
    }

    public function allow() 	// изм-ие статуса комментариев
    {
    	$this->status = 1;
    	$this->save();
    }

	public function disAllow() 	// изм-ие статуса комментариев
    {
    	$this->status = 0;
    	$this->save();
    }

    public function toggleStatus()
    {
    	if($this->status == 0) // если запр-ен и не выводится	
    	{
    		return $this->allow();
    	}	

    	return $this->disAllow();
    }


    public function remove() // удаление комментария
    {
    	$this->delete();
    }
}
