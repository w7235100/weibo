<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    /** 中间件过滤
      * UsersController constructor.
     */
    public function __construct()
    {

        $this->middleware('auth', [
            'except' => ['show','create', 'store','index']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    public function index()
    {
        $users=User::paginate(5);
        return view('static.users.index',compact('users'));
    }

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
        #session()->flash('success','欢迎你来到我们这个大家庭');
        $this->authorize('update', $user);
        return view('static.users.show',compact('user'));
    }


    /** 用户注册处理
     * @param User $user
     */
    public  function store(UsersRequest $request)
    {
       $user=User::create([
           'name'=>$request->name,
           'password'=>$request->password,
           'email'=>$request->email
       ]);
       auth()->login($user);
        session()->flash('success','欢迎你来到我们这个大家庭');
       return redirect()->route('users.show',compact('user'));
    }


    /**
     *  编辑资料展示
      */
    public function edit(User $user)
    {

        $this->authorize('update', $user);
            return view('static.users.edit',compact('user'));
    }


    /**
     *更新用户资料
     */
    public function update(User $user,Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request,[
           'name'=>'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data=[];
        $data['name']=$request->name;
        if ($request->password){
            $data['password']=$request->password;
        }
        $user->update($data);

        session()->flash('success','个人资料更新成功');
        return redirect()->route('users.show',$user->id);

    }

    /** 删除用户
     * @param User $user
     * @param Request $request
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
