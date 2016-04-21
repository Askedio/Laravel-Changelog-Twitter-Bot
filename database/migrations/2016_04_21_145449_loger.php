<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Loger extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('log', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('tweeted')->default(0);
           $table->string('version');
           $table->string('date');
           $table->enum('type', ['Added', 'Changed', 'Fixed', 'Removed']);
           $table->longtext('content');
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
         Schema::drop('log');
     }
}
