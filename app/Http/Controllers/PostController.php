<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{

    protected $postService;

    public function __construct(private PostService $post)
    {
        $this->postService = $post;
    }

    public function index()
    {
        $posts = $this->postService->getPostsForUser(auth()->id());

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function store(PostFormRequest $request)
    {
        $validated = $request->validated();
        $this->postService->createPost($validated);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully created',
        ]);
    }

    public function show($id)
    {
        $post = $this->postService->getPost($id);

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    public function update(PostFormRequest $request, $id)
    {
        $post = $this->postService->getPost($id);
        $validated = $request->validated();
        $this->postService->updatePost($post, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully updated',
        ]);
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully deleted',
        ]);
    }

}
