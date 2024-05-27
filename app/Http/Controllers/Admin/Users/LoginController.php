<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return route('admin');
        }

        return view('login', [
            'title' => 'Dang nhap'
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
            return route('admin');
        }

        return redirect()->back()->withErrors('MSG');
    }
}
