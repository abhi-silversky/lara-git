<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = auth()->user()->posts()->paginate(10);
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

        auth()->user()->posts()->create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'post_image' => $request->post_image,
            ]
        );
        session()->flash('create', 'Post Created successfully');
        return redirect(route('posts.index'));
    }

    public function show($post)
    {
        $post = Post::whereId($post)->with('user')->first();
        return view('blog-post', compact('post'));
    }
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('delete', 'Post archived successfully');
        return back();
    }
    public function edit(Post $post)
    {
        // $this->authorize('view', $post);
        // if (auth()->id() != $post->user_id) {
        //     session()->flash('update', 'You are not authorized to edit');
        //     return redirect(route('posts.index'));
        // }
        return view('admin.posts.edit', compact('post'));
    }
    public function update(PostRequest $request, Post $post)
    {

        // if (auth()->id() != $post->user_id) {
        //     session()->flash('update', 'You are not authorized');
        //     return redirect(route('posts.index'));
        // }


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
            $data['post_image'] = $request->file('post_image')->store('public/images');
        }
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $post->update($data);

        session()->flash('update', 'Post updated successfully');
        return redirect(route('posts.index'));
    }


    /// showForAdmin
    public function showForAdmin(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
    public function myPosts()
    {
    }
}
