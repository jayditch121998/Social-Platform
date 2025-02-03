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
    return $this->executeAction(function () use ($postId) {
      $comments = $this->service->getPostComments($postId);
      return $this->successResponse($comments, 'Comments retrieved successfully');
    });
  }

  public function store(Request $request): JsonResponse
  {
    return $this->executeAction(function () use ($request) {
      $validated = $request->validate([
        'parent_id' => 'nullable|exists:comments,id',
        'post_id' => 'required|exists:posts,id',
        'comment' => 'required|string|max:1000',
      ]);

      $validated['user_id'] = auth()->id();
      $comment = $this->service->createComment(CommentDTO::fromRequest($validated));

      return $this->createdResponse($comment);
    });
  }

  public function update(Request $request, Comment $comment): JsonResponse
  {
    return $this->executeAction(function () use ($request, $comment) {
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

      return $this->successResponse($comment, 'Comment updated successfully');
    });
  }

  public function destroy(Comment $comment): JsonResponse
  {
    return $this->executeAction(function () use ($comment) {
      $this->authorize('delete', $comment);
      
      $this->service->deleteComment($comment);
      return $this->deletedResponse();
    });
  }
} 