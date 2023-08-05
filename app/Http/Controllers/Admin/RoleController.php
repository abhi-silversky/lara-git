<?php

namespace App\Http\Controllers\Admin;

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
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:3', 'string']
            ]
        );
        $role =  Role::create(
            [
                'name' => Str::ucfirst($request->name),
                'slug' => Str::of(Str::lower($request->name))->slug('-'),
            ]
        );
        try {
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
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'name' => ['required', 'min:3', 'string']
            ]
        );

        try {
            $role->update(
                [
                    'name' => Str::ucfirst($request->name),
                    'slug' => Str::of(Str::lower($request->name))->slug('-')
                ]
            );
            if ($role->isDirty('name'))
                session()->flash('success', "Role \"$request->name\" updated successfully");
            else
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
}
