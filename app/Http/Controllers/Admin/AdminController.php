<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
use Throwable;

class AdminController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('admin.index');
    }
    public function edit()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }
    public function update(UpdateUserRequest $request)
    {
        // $user = auth()->user();
        // $data =
        //     [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'username' => $request->username
        //     ];
        // if ($request->has('password')) {
        //     $data['password'] = bcrypt($request->password);
        // }
        // if ($request->has('avatar')) {
        //     $data['avatar'] = $request->file('avatar')->store('public/avatars');
        // }
        // try {
        //     if ($user->update($data)) {
        //         session()->flash("success", "Your profile updated");
        //     } else session()->flash("warning", "Nothing changed");
        // } catch (Throwable $th) {
        //     session()->flash("error", "Something went wrong");
        // }
        // return redirect()->route('posts.index');
    }
}
