<?php

    /*
     * 微博控制器
     *
     * */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        //验证规则
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        //写入数据
        auth()->user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功！');
        return redirect()->back();
    }
}
