<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): View
    {
        DB::flushQueryLog();
        DB::enableQueryLog();
       $posts = Post::latest('published_at')->paginate(50);
       
        $posts = Post::with('author', 'category', 'tags', 'comments')->latest('published_at')->paginate(50);

       

        return view('posts.index', [
            'posts' => $posts,
            'queryCount' => count(DB::getQueryLog()),
        ]);
    }

    public function report(): View
    {
        DB::flushQueryLog();
        DB::enableQueryLog();
        $posts = Post::latest('published_at')->limit(200)->get();
        $posts = Post::with('author','category', 'tags', 'comments' )->latest('published_at')->limit(200)->get();

        
        return view('posts.report', [
            'posts' => $posts,
            'queryCount' => count(DB::getQueryLog()),
        ]);
    }
}
