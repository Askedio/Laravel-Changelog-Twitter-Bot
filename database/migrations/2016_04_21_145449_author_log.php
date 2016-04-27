<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AuthorLog extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
        Schema::create('author_log', function (Blueprint $table) {
           $table->integer('log_id');
           $table->integer('author_id');
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