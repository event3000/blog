<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // метод создания
    {
        Schema::table('users', function(Blueprint $table){
          $table->string('avatar')->nullable();  
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // метод удаления
    {
        Schema::table('users', function(Blueprint $table){
          $table->dropColumn('avatar');  
        });
    }
}
