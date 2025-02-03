<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends Controller
{
  public function __construct(private PostService $postService)
  {
  }

  public function index(): JsonResponse
  {
    $posts = $this->postService->getPaginatedPosts();
    return response()->json($posts);
  }

  public function store(StorePostRequest $request): JsonResponse
  {
    $postDTO = PostDTO::fromArray([
      ...$request->validated(),
      'user_id' => auth()->id()
    ]);

    $post = $this->postService->createPost($postDTO);
    return response()->json($post, Response::HTTP_CREATED);
  }

  public function show(Post $post): JsonResponse
  {
    return response()->json($post);
  }

  public function update(UpdatePostRequest $request, Post $post): JsonResponse
  {
    $this->authorize('update', $post);

    $postDTO = PostDTO::fromArray([
      ...$request->validated(),
      'user_id' => $post->user_id
    ]);

    $this->postService->updatePost($post, $postDTO);
    return response()->json($post);
  }

  public function destroy(Post $post): JsonResponse
  {
    $this->authorize('delete', $post);

    $this->postService->deletePost($post);
    return response()->json(null, Response::HTTP_NO_CONTENT);
  }
}