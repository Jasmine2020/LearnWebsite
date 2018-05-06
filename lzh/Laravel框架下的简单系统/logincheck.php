<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use DB;
class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/home';   //重定向到首页

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function verify_status(array $data)
    {
      //print_r($data);
      $email = $data['email'];
      $user = DB::select('select * from users where email = ?', [$email]);
      if($user)
      {
        if($user[0]->status ==1)
        {
          return 1;
        }
        return 0;
      }
      else
       {
           echo "未找到用户";
           return 0;
      }
    }
}
