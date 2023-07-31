<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\Attribute;
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















    // accesor & mutator
    // * @return \Illuminate\Database\Eloquent\Casts\Attribute

    protected function postImage(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return strpos($value, 'http') === 0 ? $value : asset('storage/images\\') . $value;
            },
            set: function ($value) {
                return strpos($value, 'http') === 0 ? $value : basename($value);
            }
        );
    }
}
