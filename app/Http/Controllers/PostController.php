<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $posts = Post::orderByDesc('posts.created_at')->with('user');
            $posts = Post::with('user');
            return DataTables::eloquent($posts)
                ->addIndexColumn()
                ->addColumn('image', function (Post $post) {
                    return view('custom.posts.image-index')->with('post', $post);
                })
                ->addColumn('edit', function (Post $post) {
                    return view('custom.posts.edit')->with('post', $post);
                })
                ->addColumn('delete', function (Post $post) {
                    return view('custom.posts.delete')->with('post', $post);
                })
                ->editColumn('created_at', function (Post $post) {
                    return $post->created_at->diffForHumans();
                })
                ->editColumn('title', function (Post $post) {
                    return view('custom.posts.show')->with('post', $post);
                })
                ->setRowClass('text-center')
                ->make();
        }
        return view('admin.posts.index');
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



    public function myPosts(Request $request)
    {
        if ($request->ajax()) {
            // $user = auth()->user();
            // $posts = Post::where('user_id', auth()->id())->orderByDesc('posts.created_at')->with('user');
            $posts = Post::where('user_id', auth()->id())->with('user');
            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('image', function (Post $post) {
                    return view('custom.posts.image-index')->with('post', $post);
                })
                ->addColumn('edit', function (Post $post) {
                    return view('custom.posts.edit')->with('post', $post);
                })
                ->addColumn('delete', function (Post $post) {
                    return view('custom.posts.delete')->with('post', $post);
                })
                ->editColumn('created_at', function (Post $post) {
                    return $post->created_at->diffForHumans();
                })
                ->editColumn('title', function (Post $post) {
                    return view('custom.posts.show')->with('post', $post);
                })
                ->make();
        }
        return view('admin.posts.index');
        // return view('admin.posts.index', compact('posts'));
    }
}
