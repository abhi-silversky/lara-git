<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function roleHasPermissionId(int $permission_id) {
        $roles_permissions = $this->permissions->pluck('id')->toArray();
        if (in_array($permission_id, $roles_permissions))
            return true;
        return false;
    }
}
