<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class AuthorController extends Controller
{

    public function index()
    {

        $users = \App\Author::with('logs')->paginate(100)->sortByDesc(function($row){
            return $row->logs->count();
        });


        return view('authors')->with(['users' => $users]);
    }
}
