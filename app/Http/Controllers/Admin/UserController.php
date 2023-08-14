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
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::whereDoesntHave('roles', function (Builder $query) {
                $query->where('slug', 'admin');
            });
            // $users = User::query();
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('avatar', function (User $user) {
                    return view('custom.users.image-index')->with('user', $user);
                })
                ->addColumn('edit', function (User $user) {
                    return view('custom.users.edit')->with('user', $user);
                })
                ->addColumn('delete', function (User $user) {
                    return view('custom.users.delete')->with('user', $user);
                })
                ->editColumn('created_at', function (User $user) {
                    return $user->created_at->diffForHumans();
                })
                ->editColumn('name', function (User $user) {
                    return view('custom.users.show')->with('user', $user);
                })->setRowClass('text-center')
                ->make();
        }

        return view('admin.users.index');
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
                $user->roles()->attach(7, ['created_at' => now(), 'updated_at' => now()]);
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
        // return back();
        try {
            $status = User::whereId($user->id)->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->role);
            })->exists();

            if ($status) {
                return redirect()
                    ->route('users.edit', ['user' => $user->id])
                    ->with('warning', "Role already attached");
            }
            $user->roles()->attach($request->role);

            return redirect()
                ->route('users.edit', ['user' => $user->id])
                ->with('success', "Role Attached");
        } catch (\Throwable $th) {
            return redirect()
                ->route('users.edit', ['user' => $user->id])
                ->with('error', "Something went wrong");
            // ->with('error', $th->getMessage());
        }
    }
    public function detachRole(Request $request, User $user)
    {
        try {
            $status = User::whereId($user->id)->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->role);
            })->exists();
            if (!$status) {
                return redirect()
                    ->route('users.edit', ['user' => $user->id])
                    ->with('warning', "Role already detached");
            }
            $user->roles()->detach($request->role);
            return redirect()
                ->route('users.edit', ['user' => $user->id])
                ->with('warning', "Role Detached");
        } catch (\Throwable $th) {
            return redirect()
                ->route('users.edit', ['user' => $user->id])
                ->with('warning', "Something went wrong");
        }
    }
}
