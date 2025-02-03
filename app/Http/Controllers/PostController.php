<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct(private PostService $service)
  {
  }

  public function index(): JsonResponse
  {
    return $this->executeAction(function () {
      $posts = $this->service->getPaginatedPosts();
      return $this->successResponse($posts, 'Posts retrieved successfully');
    });
  }

  public function store(Request $request): JsonResponse
  {
    return $this->executeAction(function () use ($request) {
      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
      ]);

      $validated['user_id'] = auth()->user()->id;
      $post = $this->service->createPost(PostDTO::fromRequest($validated));

      return $this->createdResponse($post);
    });
  }

  public function show(Post $post): JsonResponse
  {
    return $this->executeAction(function () use ($post) {
      return $this->successResponse($post, 'Post retrieved successfully');
    });
  }

  public function update(Request $request, Post $post): JsonResponse
  {
    return $this->executeAction(function () use ($request, $post) {
      $this->authorize('update', $post);

      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
      ]);

      $post = $this->service->updatePost($post, PostDTO::fromRequest($validated));

      return $this->successResponse($post, 'Post updated successfully');
    });
  }

  public function destroy(Post $post): JsonResponse
  {
    return $this->executeAction(function () use ($post) {
      $this->authorize('delete', $post);
      
      $this->service->deletePost($post);
      return $this->deletedResponse();
    });
  }
}