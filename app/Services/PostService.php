<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    /**
     * Create a new post.
     */
    public function createPost(array $data): Post
    {
        return Post::create($data);
    }

    /**
     * Get all public posts.
     */
    public function getPublicPosts(): Collection
    {
        return Post::where('visibility', 'public')
            ->get();
    }

    /**
     * Get public posts for a specific user.
     */
    public function getPublicPostsForUser($userId): Collection
    {
        return Post::where('visibility', 'public')
            ->where('author', $userId)
            ->get();
    }

    /**
     * Get private posts for a specific user.
     */
    public function getPrivatePostsForUser($userId): Collection
    {
        return Post::where('visibility', 'private')
            ->where('author', $userId)
            ->get();
    }

    /**
     * Get all posts belonging to a user.
     */
    public function getPostsForUser($userId): Collection
    {
        return Post::where('author', $userId)
            ->get();
    }

    /**
     * Get a single post.
     *
     * Throws ModelNotFoundException if missing.
     */
    public function getPost($id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * Update an existing post.
     */
    public function updatePost(Post $post, array $data): Post
    {
        $post->update($data);

        return $post->refresh();
    }

    /**
     * Delete a post.
     *
     * Throws ModelNotFoundException if missing.
     */
    public function deletePost($id): void
    {
        $post = Post::findOrFail($id);

        $post->delete();
    }
}