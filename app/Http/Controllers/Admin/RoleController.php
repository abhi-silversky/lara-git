<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate(20);
        return view('admin.roles.index', compact('roles'));
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
    public function store(StoreRoleRequest $request)
    {
        try {
            $role =  Role::create(
                [
                    'name' => Str::ucfirst($request->name),
                    'slug' => Str::of(Str::lower($request->name))->slug('-'),
                ]
            );
            if ($role)
                session()->flash('success', "Role \"$request->name\" Created successfully");
            else
                session()->flash('warning', "Role \"$request->name\" not exists");
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return back();
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
    public function edit(Role $role)
    {
        $role->load('permissions');
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

        try {
            $role->name = Str::ucfirst($request->name);
            $role->slug = Str::of(Str::lower($request->name))->slug('-');

            if ($role->isDirty('name')) {
                $role->save();
                session()->flash('success', "Role \"$request->name\" updated successfully");
            } else
                session()->flash('warning', "Role \"$request->name\" remains same");
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            if ($role->delete())
                session()->flash('success', "Role \"$role->name\" deleted successfully");
            else
                session()->flash('warning', 'Role not exists');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return back();
    }

    public function attachPermission(Request $request, Role $role)
    {
        $role->permissions()->attach($request->permission_id);
        return back();
    }
    public function detachPermission(Request $request, Role $role)
    {
        $role->permissions()->detach($request->permission_id);
        return back();
    }
}
