<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        return view('static.pages.home');
    }

    public function help()
    {
        return view('static.pages.help');
    }

    public function  about()
    {
        return view('static.pages.about');
    }
}
