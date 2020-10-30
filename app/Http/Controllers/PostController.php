<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class PostController extends Controller
{
    // get /posts
    public function index() {
        // view('posts.show', ['posts' => Post::latest()->get()]);
        return Post::all();
    }

    // get /posts/{id}
    public function show($id) {
        return Post::findOrFail($id);
    }

    // post /posts
    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => 'required'
        ]);
        
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $post = Post::create($data);

        return response($post, 201);
    }

    // patch /posts/{id}
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);

        if ($request->user()->id != $post->author->id) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        $request->validate([
            'title' => [Rule::unique('posts')->ignore($post->id), 'max:255'],
        ]);
        
        $data = $request->all();
        
        $post->update($data);
        $updatedPost = Post::find($id);
        
        return response($updatedPost);
    }

    // delete /posts/{id}
    public function destroy(Request $request, $id) {
        $post = Post::findOrFail($id);
        if ($request->user()->id != $post->author->id) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        $deletedPost = Post::find($id);
        $post->delete();

        return response($deletedPost);
    }
}
