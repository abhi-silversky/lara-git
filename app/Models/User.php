<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function isAdmin()
    {
        $roles = $this->roles;
        foreach ($roles as $role) {
            if ($role->slug === 'admin') return true;
        }
        return false;
    }

    public function post()
    {
        return $this->hasOne(Post::class); // one to many relationship with Post model (
    }
    public function posts()
    {
        return $this->hasMany(Post::class); // one to many relationship with Post model (
    }


    /*
        # Permissions
    */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    /*
        # roles
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }




    /// accessor
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return ucwords($value);
            },
            set: function ($value) {
                return strtolower(trim($value));
            }
        );
    }
    protected function email(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value;
            },
            set: function ($value) {
                return strtolower(trim($value));
            }
        );
    }
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return asset("storage/avatars\\$value");
            },
            set: function ($value) {
                return basename($value);
            }
        );
    }
}
