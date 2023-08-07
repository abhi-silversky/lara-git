<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $user = $user->whereId($user->id)->with('roles')->first();
        $user->load('roles');
        $this->authorize('view', $user);

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        // $data =
        //     [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'username' => $request->username
        //     ];
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $data = [];
        if ($request->filled('password')) {
            // $data['password'] = bcrypt($request->password);
            $user->password = bcrypt($request->password);
        }
        if ($request->has('avatar')) {
            // $data['avatar'] = $request->file('avatar')->store('public/avatars');
            $user->avatar = $request->file('avatar')->store('public/avatars');
        }
        try {
            if ($user->isDirty()) {
                $user->save();
                session()->flash("success", "\"$user->name\" profile updated");
            } else session()->flash("warning", "Nothing changed");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong");
        }
        if (auth()->user()->userHasRole('admin')) {
            return redirect()->route('admin.users.index');
        }
        return redirect()->route('posts.index');
    }
}
