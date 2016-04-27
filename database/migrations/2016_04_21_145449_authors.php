<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Author extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('author_log', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('avatar')->nullable(;
           $table->string('url')->nullable(;
           $table->string('website')->nullable(;
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
         Schema::drop('author_log');
     }
}
