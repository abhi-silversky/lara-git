<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $posts = Post::latest()->take(5)->get(); // // 2 3 4 6 7 8
        $posts = Post::with('user')->latest()->paginate(10); // // 2 3 4 6 7 8
        // dd($posts);
        return view('home', compact('posts'));
    }
}
