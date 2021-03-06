<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Authors extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
        Schema::create('authors', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('avatar')->nullable();
           $table->string('url')->nullable();
           $table->string('website')->nullable();
           $table->string('twitter')->nullable();
           $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('authors');
     }
}
