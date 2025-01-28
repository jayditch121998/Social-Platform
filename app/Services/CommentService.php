<?php

namespace App\Services;

use App\DTOs\CommentDTO;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService
{
  public function __construct(private CommentRepository $repository)
  {
  }

  public function createComment(CommentDTO $dto): Comment
  {
    return $this->repository->create($dto);
  }

  public function updateComment(Comment $comment, CommentDTO $dto): bool
  {
    return $this->repository->update($comment, $dto);
  }

  public function deleteComment(Comment $comment): bool
  {
    return $this->repository->delete($comment);
  }

  public function getPostComments(int $postId, int $perPage = 15): LengthAwarePaginator
  {
    return $this->repository->getPostComments($postId, $perPage);
  }

  public function findById(int $id): ?Comment
  {
    return $this->repository->findById($id);
  }
}