<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('admin.permissions.index', compact('permissions'));
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
    public function store(StorePermissionRequest $request)
    {
        try {
            $permission =  Permission::create(
                [
                    'name' => Str::ucfirst($request->name),
                    'slug' => Str::of(Str::lower($request->name))->slug('-'),
                ]
            );
            if ($permission)
                session()->flash('success', "Permission \"$request->name\" Created successfully");
            else
                session()->flash('warning', "Permission \"$request->name\" not created");
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
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            $permission->name = Str::ucfirst($request->name);
            $permission->slug = Str::of(Str::lower($request->name))->slug('-');

            if ($permission->isDirty('name')) {
                $name = $permission->getOriginal('name');
                $permission->save();
                session()->flash('success', "Permission \"$name\" updated successfully");
            } else
                session()->flash('warning', "Nothing changed");
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            if ($permission->delete())
                session()->flash('success', "Permission \"$permission->name\" deleted successfully");
            else
                session()->flash('warning', 'Permission not exists');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return back();
    }
}
