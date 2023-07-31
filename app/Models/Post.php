<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['title', 'content', 'post_image'];


    public function user()
    {
        return $this->belongsTo(User::class); //one to many relationship with User model.
    }
}
