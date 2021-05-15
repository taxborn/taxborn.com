<?php

namespace App\Http\Controllers;

use Wink\WinkPost;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.posts')
            ->with('posts', WinkPost::with('tags')->orderBy('created_at', 'desc')->live()->get());
    }

    public function show(WinkPost $post)
    {
        // Check if the post is in a draft form, and only show if the current wink guard is present.
        if (!$post->published && !Auth::guard('wink')->check()) {
            return abort(404);
        }

        // Get the estimated time to read
        $estimatedTimeToRead = floor(str_word_count(strip_tags($post->content)) / 200) . ' minute read';

        return view('blog.post')->with('post', $post)->with('estimatedTimeToRead', $estimatedTimeToRead);
    }
}
