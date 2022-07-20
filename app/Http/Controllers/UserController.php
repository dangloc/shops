<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Hash;
use Mail;

class UserController extends Controller
{
   public function login()
   {
    return view('auth.login', [
        'title' => 'Login',
    ]);
   }

   public function store(Request $request)
   {

    
    $this->validate($request, [
        'email' => 'required|email:filter',
        'password' => 'required'
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    if (Auth::attempt(['email' => $email,'password' =>  $password ],$request->input('remember'))){
        
        return redirect('/');

    }
    Session::flash('error', 'Email hoặc Password không đúng');
    return redirect()->back();
   }

   public function logout(){
    Auth::logout();
    return redirect('/');
   }

   public function register()
   {
    if(Auth::check())
        {
             return redirect()->route('/');
        }
        else
        {
    	    return view('auth.register',[
                'title' => 'Register'
            ]);
        }
   }

   public function storeRegister(Request $request)
   {

    $this->validate($request,
    [
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:6|max:20',
        'name'=>'required',
        're_password'=>'required|same:password'
    ],
    [
        'email.required'=>'Vui lòng nhập email',
        'email.email'=>'Không đúng định dạng email',
        'email.unique'=>'Email đã có người sử dụng',
        'password.required'=>'Vui lòng nhập mật khẩu',
        're_password.same'=>'Mật khẩu không giống nhau',
        'password.min'=>'Mật khẩu ít nhất 6 kí tự'
    ]);
$user = new User();
$user->name = $request->name;
$user->email = $request->email;
$user->password = Hash::make($request->password);
$user->save();
Mail::send('mail.success',['nguoidung'=>$user], function ($message) use($user)
{
    $message->from('dangbaloc23@gmail.com',"LD store");
    $message->to($user->email,'$user->name');
    $message->subject('Xác nhận tài khoản');
});
$request->session()->flash('thongbao', 'Đăng kí thành công, Kiểm tra mail để kích hoạt');
return redirect('/auth/login');
   }
}
