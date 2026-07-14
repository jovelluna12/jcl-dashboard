<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function createPost(array $data): Post
    {
        return Post::create($data);
    }

    public function getPublicPosts()
    {
        return Post::where('visibility', 'public')->get();
    }

    public function getPrivatePostsForUser($userId)
    {
        return Post::where('visibility', 'private')->where('author', $userId)->get();
    }

    public function getPublicPostsForUser($userId)
    {
        return Post::where('visibility', 'public')->where('author', $userId)->get();
    }

    public function getPostsForUser($userId)
    {
        return Post::where('author', $userId)->get();
    }

    public function getPost($id): ?Post
    {
        return Post::find($id);
    }

    public function updatePost(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    public function deletePost($id): void
    {
        Post::destroy($id);
    }
}

