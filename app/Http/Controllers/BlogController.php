<?php

namespace App\Http\Controllers;

use Wink\WinkPost;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.posts')
            ->with('posts', WinkPost::orderBy('created_at', 'desc')->get());
    }

    public function show(WinkPost $post)
    {
        return view('blog.post')->with('post', $post);
    }
}
