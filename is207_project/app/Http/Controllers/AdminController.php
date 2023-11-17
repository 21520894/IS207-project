<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Admin;
use App\Http\Requests;
use Session;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

session_start();
class AdminController extends Controller
{
    public function index(){
        return view('clients/admin/admin_login');
    }
    public function show(Admin $admin){
        return view('clients/admin/admin_page',compact('admin'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('Username', 'Password');

        if (Auth::guard('user')->attempt($credentials)) {
            // Người dùng từ bảng "users" xác thực thành công
            return redirect()->intended('front_end/user_page');
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            // Người dùng từ bảng "admin" xác thực thành công
            return redirect()->intended('front_end/admin_page');
        } else {
            // Xác thực không thành công
            return back()->withInput()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }
    }
    public function logout(){

    }
}
