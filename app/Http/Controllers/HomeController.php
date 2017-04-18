<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Posts\Models\Post;
use Modules\Comments\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::where('type', 'post')->get();
        $comments = Comment::all();
        $pages = Post::where('type', 'page')->get();
        return view('home', [
                "posts" => $posts,
                "comments" => $comments,
                "pages" => $pages
            ]);
    }
}
