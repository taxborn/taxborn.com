<?php

namespace App\Http\Controllers;

use Wink\WinkPost;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home')
            ->with('posts', WinkPost::orderBy('created_at', 'desc')->take(3)->get())
            ->with('birthdate', Carbon::create(2001, 10, 18));
    }
}
