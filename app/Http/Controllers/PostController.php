<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    public function store(PostFormRequest $request)
    {
        $validated = $request->validated();
        Post::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully created',
        ]);
    }

    public function get(Request $request)
    {
        $posts = Post::all();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function delete($id)
    {
        Post::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully deleted',
        ]);
    }
}
