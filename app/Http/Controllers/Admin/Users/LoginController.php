<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;
use Yoeunes\Toastr\Toastr as ToastrToastr;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('user.list');
        }

        return view('login.index', [
            'title' => 'Đăng Nhập',
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        $rememberMe = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $rememberMe)) {
            $redirect = $request->input('redirect');

            if (!empty($redirect)) {
                return redirect($request->input('redirect'));
            }

            return redirect()->intended(Auth::user()->group_role == 1 ? route('user.list') : route('customer.list'))
            ->withSuccess('Login success!');
        }

        return redirect('login')->withError('Login Failed: Your user ID or password is incorrect!');

        // if(Auth::attempt([
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password')

        // ], $request->input('remember_token'))) {

        //     // return redirect()->route('user.list');
        //     return redirect()->intended(route('user.list'))->withSuccess('Login success!');
        // }
        // $request = Toastr()->error('Login Failed: Your user ID or password is incorrect!');

        // return redirect()->back();
    }

    public function postRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'group_role' => 'required',
            'is_active' => 'required',
        ]);

        $data = $request->all();
        $this->create($data);

        return redirect()->route('login')->withSuccess('Register success!');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'group_role' => $data['group_role'],
            'is_active' => $data['is_active'],
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json(['error' => 'Old Password doesn\'t match!'], 422);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

            return response()->json(['success' => 'Password changed successfully!']);
    }

}
