<?php

namespace App;

use \Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // связь - каждй юзер может иметь посты (многое к одному)
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // комменты (многое к одному)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function add($fields){ // добавление
        $user = new static;
        $user->fill($fields);
        
        $user->save;

        return $user;
    }   


    public function edit($fields) // редактирование
    {
        $this->fill($fields);
        $this->save();
    }

    public function generatePassword($password)
    {
        if($password != null)
        {
           $this->password = bcrypt($password); 
           $this->save();
        }
    }

    public function remove() // удаление юзера
    {
        $this->removeAvatar(); // вызов отд метода удаления
        $this->delete();
    }

    public function uploadAvatar($image)  // МЕТОД загрузки картинки аватара
    {
        if ( $image == null ) { return; }

        $this->removeAvatar(); // вызов отд метода удаления
        
        $filename = str_random(10) . '.' . $image->extension(); // генерация назв-я файла
        $image->storeAs('uploads', $filename); // сохр-ие в папку uploads
        $this->avatar = $filename; // переброс в поле images
        $this -> save(); // сохранение
    }

    public function removeAvatar()
    {
        if ($this->avatar != null) 
        {
           Storage::delete('uploads/' . $this->avatar); // удаление предид. картинки  
        }        
    }


    public function getImage() // метод для вывода картинки
    {   
        if ($this->avatar == null)
        {
            return '/img/no-image.png'; // картинка аватара по ум-нию
        } 
        return '/uploads/' . $this->avatar;
    }

    
    public function makeAdmin() // создать админа
    {
        $this->is_admin = 1;
        $this-> save();
    }

    public function makeNormal() // создание обыч юзера
    {
        $this->is_admin = 0;
        $this-> save();
    }

    public function toggleAdmin($value)
    {
        if ($value == null)
        {
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function ban() // бан юзера
    {
        $this->status = User::IS_BANNED; // будет статус 1 тк прописано в константе
        $this-> save();
    }

    public function unban() // разбан юзера
    {
        $this->status = User::IS_ACTIVE; // будет статус 0 тк прописано в константе
        $this-> save();
    }

    public function toggleBan($value) // переключатель
    {
        if ($value == null)
        {
            return $this->unban();
        }

        return $this->ban();
    }
}
