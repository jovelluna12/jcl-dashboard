<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {

        if ($request->has('author')) {
            $authorId = $request->query('author');
            $posts = $this->postService->getPublicPostsForUser($authorId);
        } else {
            $posts = $this->postService->getPublicPosts();
        }

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function retrievePost($id)
    {

        if (isset($id)) {
            $posts = $this->postService->getPost($id);
        } else {
            throw new Exception('Post ID is required to retrieve a post.', 400);
        }

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

}