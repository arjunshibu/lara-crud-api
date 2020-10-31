<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    // get /users
    public function index()
    {
        return response(User::all());
    }

    // get /users/{id}
    public function show($id)
    {
        return response(User::findOrFail($id));
    }

    // get /users/{id}/posts
    public function showPosts($id) {
        return response(Post::where('author', $id)->latest()->get());
    }
}
