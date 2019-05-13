<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home()
    {
        $feed_items = [];
        if (auth()->check()) {
            $feed_items = auth()-> user()->feed()->paginate(10);
        }
        return view('static.pages.home',compact('feed_items'));
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
