<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        return view('blog-post');
    }
    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(Request $request)
    {
        // request()->validate()
        dd($request->all());
        return view('admin.posts.create');
    }


    public function show($post)
    {
        $post = Post::whereId($post)->with('user')->get()[0];
        // dd($post);
        return view('blog-post', compact('post'));
    }
}
