<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Create;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\CreateForRequest;
use App\Http\Requests\UpdateForRequest;
use App\Models\Mst_users;
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
        ->orderBy('is_active','asc')
        ->orderBy('group_role','asc')
        ->paginate(10);

        return view('user.list', [
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

    public function ShowUser($id)
    {
        $data =  $this->userService->handleGetUser($id);

        if (empty($data)) {
            return respondWithJsonError(DATA_NOT_FOUND, NOT_FOUND_CODE);
        }

        $html = view('user.modal.ajax_edit', [
            'user' => $data,
        ])->render();


        return response()->json([ 'html' => $html]);
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

    public function search(Request $request)
    {
        $query = User::query();

        $filters = [
            'name' => $request->input('search'),
            'email' => $request->input('fromEmail'),
            'group_role' => $request->input('groupRole'),
            'is_active' => $request->input('isActive'),
        ];

        foreach ($filters as $column => $value) {
            if (!empty($value)) {
                $query->orWhere($column, 'LIKE', "%{$value}%");
            }
        }
        // $query->orderBy('group_role', 'ASC')
        //         ->orderBy('is_active', 'ASC');
        $viewUsers = $query->paginate(10);

        return view('user.list', [
            'viewUsers' => $viewUsers,
        ]);
    }
}
