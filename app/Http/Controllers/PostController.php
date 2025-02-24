<?php

namespace App\Http\Controllers;

use App\Events\PostCreate;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.post', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string'
        ]);

        $post = Post::create([
            'user_id'   => Auth::id(),
            'title'     => $request->title,
            'body'      => $request->body
        ]);

        event(new PostCreate($post));

        return response()->json([
            'data' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string',
        ]);
    
        $post->update([
            'title' => $request->title,
            'body'  => $request->body
        ]);

        return response()->json([
            'data' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully']);
        }

        return response()->json(['message' => 'Post not found'], 404);
    }
}
