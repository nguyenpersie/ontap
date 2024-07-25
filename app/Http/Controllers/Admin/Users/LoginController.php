<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Yoeunes\Toastr\Facades\Toastr;
use Yoeunes\Toastr\Toastr as ToastrToastr;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('user.list');
        }

        return view('login', [
            'title' => 'Đăng Nhập'
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')

        ], $request->input('remember_token'))) {
            return redirect()->route('user.list');
        }
        $request = Toastr()->error('email or password is incorrect');

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/users/login');
    }

}
