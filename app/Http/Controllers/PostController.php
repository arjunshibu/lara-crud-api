<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class PostController extends Controller
{
    // get /posts
    public function index() {
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
        $data['author'] = $request->user()->id;
        
        $post = Post::create($data);

        return response($post, 201);
    }

    // patch /posts/{id}
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);

        if ($request->user()->id != $post->author) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        $request->validate([
            'title' => [Rule::unique('posts')->ignore($post->id), 'max:255'],
        ]);
        
        $data = $request->all();
        
        $post->update($data);
        $post['author'] = $post['author'];

        return response($post);
    }

    // delete /posts/{id}
    public function destroy(Request $request, $id) {
        $post = Post::findOrFail($id);
        if ($request->user()->id != $post->author) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        $post->delete();
        $post['author'] = $post['author'];

        return response($post);
    }
}
