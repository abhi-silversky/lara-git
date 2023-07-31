<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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


    public function store(PostRequest $request)
    {
        if (isset($request->post_image)) {
            $path = basename($request->file('post_image')->store('public/images'));
            auth()->user()->posts()->create(
                [
                    'title' => $request->title,
                    'content' => $request->content,
                    'post_image' => $path,
                ]
            );
        } else {
            auth()->user()->posts()->create(
                [
                    'title' => $request->title,
                    'content' => $request->content,
                ]
            );
        }
        // return redirect(route('admin.index'));
        return back();
    }


    public function show($post)
    {
        $post = Post::whereId($post)->with('user')->get()[0];
        // dd($post);
        return view('blog-post', compact('post'));
    }
}
