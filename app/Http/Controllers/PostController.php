<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        if ($request->has('post_image')) {
            $request->post_image = $request->file('post_image')->store('public/images');
        }

        $post = auth()->user()->posts()->create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'post_image' => $request->post_image,
            ]
        );
        try {
            if ($post)
                session()->flash('success', 'Post Created successfully');
            else
                session()->flash('warning', 'Post not created');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return redirect(route('posts.index'));
    }

    public function show($post)
    {
        $post = Post::whereId($post)->with('user')->first();
        return view('admin.posts.show', compact('post'));
    }
    public function destroy(Post $post)
    {
        try {
            if ($post->delete())
                session()->flash('success', 'Post archived successfully');
            else
                session()->flash('warning', 'Post not exists');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return back();
    }
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }
    public function update(PostRequest $request, Post $post)
    {
        # 1
        // $post->title = $request->title;
        // $post->content = $request->content;
        // if ($request->has('post_image')) {
        //     $post->post_image = $request->file('post_image')->store('public/images');
        // }
        // $post->save();

        # 2
        $data = [];
        if ($request->has('post_image')) {
            // $data['post_image'] = $request->file('post_image')->store('public/images');
            $post->post_image = $request->file('post_image')->store('public/images');
        }
        // $data['title'] = $request->title;
        // $data['content'] = $request->content;
        $post->title = $request->title;
        $post->content = $request->content;
        try {
            if ($post->isDirty(['title', 'content', 'post_image'])) {
                $post->save(); // fill data & save()
                session()->flash('success', 'Post updated successfully');
            } else
                session()->flash('warning', 'Nothing changed');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something went wrong');
        }
        return redirect(route('posts.index'));
    }


    /// showForAdmin
    public function publicShow(Post $post)
    {
        return view('blog-post', compact('post'));
    }
    public function myPosts()
    {
        $posts = auth()->user()->posts()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
}
