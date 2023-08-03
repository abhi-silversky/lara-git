<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::oldest()->paginate(10, ['*'], 'pagenumber');
        return view('admin.users.index', compact('users'));
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $data =
            [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username
            ];
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->has('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('public/avatars');
        }
        try {
            if ($user->update($data)) {
                session()->flash("success", "Your profile updated");
            } else session()->flash("warning", "Nothing changed");
        } catch (Throwable $th) {
            session()->flash("error", "Something went wrong");
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            if ($user->delete())
                session()->flash('success', 'User deleted');
            else
                session()->flash('warning', 'User already deleted');
        } catch (Throwable $th) {
            session()->flash('error', 'Something went wrong');
        }
        return back();
    }
}
