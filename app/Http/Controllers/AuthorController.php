<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Carbon\Carbon;

class AuthorController extends Controller
{

    public function index()
    {

        $users = \App\Author::with(['logs' => function($query){
                 $query->whereDate('created_at', '>=', Carbon::today()->subMonth()->toDateString());
               }])->paginate(100)->sortByDesc(function($row){
            return $row->logs->count();
        });


        return view('authors')->with(['users' => $users]);
    }
}
