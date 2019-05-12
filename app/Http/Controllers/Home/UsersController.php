<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * 注册页面
     */
    public function  index()
    {
        return view('static.users.index');
    }
}
