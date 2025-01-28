<?php

namespace App\Repositories;

use App\DTOs\CommentDTO;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository
{
  public function __construct(private Comment $model)
  {
  }

  public function create(CommentDTO $dto): Comment
  {
    return $this->model->create((array) $dto);
  }

  public function update(Comment $comment, CommentDTO $dto): bool
  {
    return $comment->update((array) $dto);
  }

  public function delete(Comment $comment): bool
  {
    return $comment->delete();
  }

  public function findById(int $id): ?Comment
  {
    return $this->model->find($id);
  }

  public function getPostComments(int $postId, int $perPage = 15): LengthAwarePaginator
  {
    return $this->model
      ->where('post_id', $postId)
      ->whereNull('parent_id')
      ->with(['user', 'replies.user'])
      ->paginate($perPage);
  }
}