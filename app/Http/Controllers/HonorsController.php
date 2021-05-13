<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HonorsController extends Controller
{
    public function index()
    {
        return view('honors.index');
    }

    public function research()
    {
        return view('honors.research');
    }

    public function leadership()
    {
        return view('honors.leadership');
    }

    public function globalCitizenship()
    {
        return view('honors.global-citizenship');
    }
}
