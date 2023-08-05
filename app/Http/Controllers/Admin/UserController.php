<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        // $users = User::latest()->paginate(10, ['*'], 'pagenumber');
        // $users = User::with(
        //     ['roles' => function (BelongsToMany $query) {
        //         $query->where('roles.slug', '<>', 'db-manager');
        //     }]
        // )->get();

        $users = User::WhereHas('roles', function (Builder $query) {
            $query->where('slug', '<>', 'admin');
        }, '>=', 1)->get(); // get all users who are not admins

        // dd($users);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        try {
            if ($user) {
                $user->roles()->attach(7,['created_at'=>now(),'updated_at'=>now()]);
                session()->flash('success', 'User Created successfully');
            } else
                session()->flash('warning', 'User not created');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return redirect()->route('admin.users.index');
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


    public function attachRole(Request $request, User $user)
    {
        // $user->roles()->attach($role);
        $user->roles()->attach($request->role);
        return back();
    }
    public function detachRole(Request $request, User $user)
    {
        $user->roles()->detach($request->role);
        return back();
    }
}
