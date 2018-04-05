<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public static function add($email) // метод админки - сюда приходит отвалидированный email
    {
    	$sub = new static; // созд-ем новый экз-р класса
    	$sub->email = $email; // закидываем мыло
    	$sub->save(); // сохраняем

    	return $sub;
    }

    public function generateToken() // генерация  токена для подписчика
    {
        $this->token = str_random(100);
        $this->save();
    }

    public function remove() // метод админки - удаление подписчика
    {
    	$this->delete();
    }
}
