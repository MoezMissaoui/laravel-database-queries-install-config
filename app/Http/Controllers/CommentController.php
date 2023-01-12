<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{


    public function index()
    {
        $comments = DB::table('comments')->select()->get();

        dump($comments);
    }
}
