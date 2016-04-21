<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $version = App\Log::distinct('version')->take(1)->get();

    $rows = App\Log::where('version', '=', $version[0]->version)->get();

    $results = [
      'Added' => [],
      'Changed' => [],
      'Fixed' => [],
      'Removed' => [],
    ];

    foreach ($rows as $row) {
      $results[$row->type][] = $row;
    }

    $return = [
      'version' => $version[0]->version,
      'date' => $version[0]->date,
      'changes'    => $results
    ];


    return request()->has('json') ? $return : view('welcome')->with($return);
});
