<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $roles = Role::orderBy('name', 'asc');
            $roles = Role::query();
            return DataTables::eloquent($roles)
                ->addIndexColumn()
                ->addColumn('delete', function (Role $role) {
                    return view('custom.roles.delete')->with('role', $role);
                })
                ->editColumn('created_at', function (Role $role) {
                    return $role->created_at->diffForHumans();
                })
                ->editColumn('name', function (Role $role) {
                    return view('custom.roles.edit')->with('role', $role);
                })
                ->setRowClass('text-center')
                ->make();
        }
        return view('admin.roles.index');
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

    public function edit(Request $request, Role $role)
    {
        $role->load('permissions');

        if ($request->ajax()) {
            // $roles = Role::orderByDesc('created_at')->newQuery();
            // $roles = Permission::latest('updated_at');
            $roles = Permission::query();
            return DataTables::eloquent($roles)
                ->addIndexColumn()
                ->addColumn('status', function (Permission $permission) use ($role) {
                    return view('custom.roles.has-permission', compact('permission', 'role'));
                })
                ->addColumn('attach', function (Permission $permission) use ($role) {
                    return view('custom.roles.permission-attach', compact('permission', 'role'));
                })
                ->addColumn('detach', function (Permission $permission) use ($role) {
                    return view('custom.roles.permission-detach', compact('permission', 'role'));
                })
                ->setRowClass('text-center')
                ->make();
        }
        return view('admin.roles.edit', compact('role'));
    }


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
        try {
            $status = Role::whereId($role->id)->whereHas('permissions', function ($q) use ($request) {
                $q->where('id', $request->permission_id);
            })->exists();

            if ($status) {
                // session()->flash('success', "Role \"$role->name\" Attached");
                return redirect()
                    ->route('admin.roles.edit', ['role' => $role->id])
                    ->with('warning', "Permission already attached");
            }
            $role->permissions()->attach($request->permission_id);
            return redirect()
                ->route('admin.roles.edit', ['role' => $role->id])
                ->with('warning', "Permission Attached");
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.roles.edit', ['role' => $role->id])
                ->with('error', "Something went wrong");
            // ->with('error', $th->getMessage());
        }
    }
    public function detachPermission(Request $request, Role $role)
    {
        try {
            $status = Role::whereId($role->id)->whereHas('permissions', function ($q) use ($request) {
                $q->where('id', $request->permission_id);
            })->exists();
            if (!$status) {
                return redirect()
                    ->route('admin.roles.edit', ['role' => $role->id])
                    ->with('warning', "Permission already detached");
            }
            $role->permissions()->detach($request->permission_id);
            return redirect()
                ->route('admin.roles.edit', ['role' => $role->id])
                ->with('success', "Permission Detached");
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.roles.edit', ['role' => $role->id])
                ->with('error', "Something went wrong");
            // ->with('error', $th->getMessage());
        }
    }
}
