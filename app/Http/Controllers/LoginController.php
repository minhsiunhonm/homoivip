<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\login;
use App\Http\Requests\register;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
    	return view('register');
    }
    public function plogin(login $request)
    {
    	$email = $request['email'];
    	$password = $request['password'];
        $user = DB::table('users')->select('id','hidden','rule')->where('email',$email)->get();
        if (count($user) == 1) {
            foreach ($user as $key) {
                $hidden = $key->hidden;
            }
            if ($hidden == 1) {
                $messages = 'Tài khoản bị khóa';
                return redirect()->back()->with('messages',$messages);
            }
        }
    	if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            if (Auth::user()->rule == 1) {
                return redirect()->route('project.index');
            }
            return redirect()->back();
        }else{
        	$messages = 'Tên đăng nhập hoặc tài khoản không đúng!';
            return redirect()->back()->with('messages',$messages);
    	}
    }
    public function posregister(register $rq)
    {
        $usercheck = DB::table('users')->where('email',$rq->email)->get();
        if (count($usercheck) > 0) {
            return redirect()->back()->with('message', 'Email đã tồn tại.');
        }elseif($rq->checkboxxx != 'on'){
            return redirect()->back()->with('message', 'Bạn chưa đồng ý với các điều khoản dịch vụ.');
        }
        $users = new user(); 
        $users->rule = '8';
        $users->hidden = '0';
        $users->very = '0';
        $users->name = $rq->name;
        $users->avatar = 'logo.png';
        $users->linkprofile = time();
        $users->email = $rq->email;
        $users->password = bcrypt($rq->password);
        $users->gender = '1';
        $users->save(); 
        return redirect()->route('login')->with('messagess', 'Đăng ký tài khoản thành công.');
    }
}
