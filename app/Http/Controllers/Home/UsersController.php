<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    /** 中间件过滤
      * UsersController constructor.
     */
    public function __construct()
    {

        $this->middleware('auth', [
            'except' => ['show','create', 'store','index','confirmEmail']
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

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
     /*  auth()->login($user);
        session()->flash('success','欢迎你来到我们这个大家庭');
       return redirect()->route('users.show',compact('user'));*/
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

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        auth()->login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show',compact('user') );
    }

    /**激活邮箱处理
     * @param $user
     */
    protected function sendEmailConfirmationTo($user)
    {

        $view = 'static.emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
