<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{


    public function index()
    {
        $comments = DB::table('comments')->select()->get();

        dump($comments);
    }

    public function factory_comments($comment_number)
    {
        Comment::factory($comment_number)->create();
    }
}
