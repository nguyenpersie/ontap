<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Create;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\CreateForRequest;
use App\Http\Requests\UpdateForRequest;
use Yoeunes\Toastr\Facades\Toastr;
use Yoeunes\Toastr\Toastr as ToastrToastr;
use App\Models\User;

class UserController extends Controller
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        $getUsers = $this->userService->handleGetUsers();

         $getUsers = User::query()
        ->orderBy('is_active','desc')
        ->orderBy('group_role','asc')
        ->paginate(20);


        return view('user', [
            'title' => 'Trang quản lý user',
            'titleAdd' => 'Thêm User',
            'viewUsers' => $getUsers,
        ]);
    }

    public function postCreate(CreateForRequest $request)
    {
        $request->validate(
            CreateForRequest::userRules(),
            CreateForRequest::userMessages()
        );

        $this->userService->handleCreateUser($request->input());

        return redirect()->back()->with('success', 'User create successfully.');
    }

    public function updateUser(UpdateForRequest $request, $id)
    {
        $request->validate(
            UpdateForRequest::userRules(),
            UpdateForRequest::userMessages()
        );

        $modelUser = $this->userService->handleGetUser($id);

        if (empty($modelUser)) {
            return redirect()->back()->with('error', 'User not found !');
        }

        $this->userService->handleUpdateUser($modelUser, $request->input());

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $modelUser = $this->userService->handleGetUser($id);

        if (empty($modelUser)) {
            return redirect()->back()->with('error', 'User not found !');
        }

        $this->userService->handleDeleteUser($modelUser);

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
