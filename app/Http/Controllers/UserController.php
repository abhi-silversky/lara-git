<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

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


    public function edit(Request $request, User $user)
    {
        // $user = $user->whereId($user->id)->with('roles')->first();
        $user->load('roles');
        $this->authorize('view', $user);


        if ($request->ajax()) {
            // $roles = Role::orderByDesc('created_at')->newQuery();
            $roles = Role::latest('updated_at');
            $roles = Role::query();
            return DataTables::eloquent($roles)
                ->addIndexColumn()
                ->addColumn('status', function (Role $role) use ($user) {
                    return view('custom.users.has-role', compact('role', 'user'));
                })
                ->addColumn('attach', function (Role $role) use ($user) {
                    return view('custom.users.role-attach', compact('role', 'user'));
                })
                ->addColumn('detach', function (Role $role) use ($user) {
                    return view('custom.users.role-detach', compact('role', 'user'));
                })
                ->setRowClass('text-center')
                ->make();
        }
        return view('admin.users.edit', compact('user'));
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('avatar')) {
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
