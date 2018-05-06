<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;
    public function showRegistrationForm()
    {
        return view('auth.register');//返回一个注册界面
    }

     public function activeAccount(Request $request)
     {
       $this->active($request->all());//新增激活函数
     }

     public function register(Request $request)
     {
       $rand = str_random(40);   //添加随机字符串 用于用户激活验证
       $request->merge(['token' => $rand]);
        $this->validator($request->all())->validate();

          $this->send($request->all());  //新增加发送邮件函数

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        echo "注册成功，请及时激活";
        //return $this->registered($request, $user)
          //              ?: redirect($this->redirectPath());
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function registered(Request $request, $user)
    {
        //
    }
}
