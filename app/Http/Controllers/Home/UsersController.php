<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * 注册页面
     */
    public function  create()
    {
        return view('static.users.create');
    }

    /**用户个人页面
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user){
        return view('static.users.show',compact('user'));
    }


    /** 用户注册处理
     * @param User $user
     */
    public  function store(Request $request)
    {
        dump($request->all());

    }
}
