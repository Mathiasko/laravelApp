<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts= Post::get(); // gets all posts
        $posts= Post::with('user', 'likes')->paginate(20); // Eager loading, so we receive both posts and like with 1 query

        return view('posts.index', [
            "posts"=>$posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Post::create([
        //     'user_id' => auth()->id(),
        //     'body' => $request->body,
        // ]);

            //  OR

        // $request->user()->posts()->create([
        //     'body'=> $request->body
        // ]);

            //  OR

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

}
