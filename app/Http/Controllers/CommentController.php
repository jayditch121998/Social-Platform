<?php

namespace App\Http\Controllers;

use App\DTOs\CommentDTO;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function __construct(private CommentService $service)
  {
  }

  public function index(Request $request, int $postId): JsonResponse
  {
    $comments = $this->service->getPostComments($postId);
    return response()->json($comments);
  }

  public function store(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'parent_id' => 'nullable|exists:comments,id',
      'post_id' => 'required|exists:posts,id',
      'comment' => 'required|string|max:1000',
    ]);

    $validated['user_id'] = auth()->id();
    $comment = $this->service->createComment(CommentDTO::fromRequest($validated));

    return response()->json($comment, 201);
  }

  public function update(Request $request, Comment $comment): JsonResponse
  {
    $this->authorize('update', $comment);

    $validated = $request->validate([
      'comment' => 'required|string|max:1000',
    ]);

    $dto = new CommentDTO(
      parent_id: $comment->parent_id,
      user_id: $comment->user_id,
      post_id: $comment->post_id,
      comment: $validated['comment'],
      like_count: $comment->like_count
    );

    $this->service->updateComment($comment, $dto);

    return response()->json($comment);
  }

  public function destroy(Comment $comment): JsonResponse
  {
    $this->authorize('delete', $comment);
    
    $this->service->deleteComment($comment);
    return response()->json(null, 204);
  }
} 