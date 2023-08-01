<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

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
    protected function title(): Attribute
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
    protected function content(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return ucfirst($value);
            },
            set: function ($value) {
                return strtolower(trim($value));
            }
        );
    }
}
