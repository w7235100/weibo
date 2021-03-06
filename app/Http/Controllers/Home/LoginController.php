<?php
/*
 * 用户登录控制器
 *
 * */
namespace App\Http\Controllers\Home;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    /**
     * 用户登录界面显示
      */
    public function index()
    {
        return view('static.login.index');
    }

    /**
     * 用户登录操作
     */
    public function login(LoginRequest $request)
    {
        #dump($request->password);
      $ret=auth()->attempt(['email'=>$request->email,'password'=>$request->password]);
         if (!$ret){
            session()->flash('danger','账号或密码不正确');
            return redirect()->back()->withInput();
         }


         $user=auth()->user();
         if ($user->activated){
             session()->flash('success','欢迎回来!');


             return  redirect()->route('users.show',$user);
         }
        auth()->logout();
        session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
        return redirect('/');


    }


    /**
     * 用户退出操作
     */
    public function logout()
    {
        auth()->logout();
        session()->flash('success','您已成功退出!');
        return redirect(route('login.index'));
    }
}
