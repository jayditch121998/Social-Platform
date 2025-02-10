<?php

namespace App\Services;

use App\DTOs\LikeDTO;
use App\Repositories\LikeRepository;

class LikeService
{
  public function __construct(private LikeRepository $repository)
  {
  }

  public function toggleLike(LikeDTO $dto): bool
  {
    return $this->repository->toggle($dto);
  }

  public function getLikeCount(int $likeableId, string $likeableType): int
  {
    return $this->repository->getLikeCount($likeableId, $likeableType);
  }

  public function hasLiked(int $userId, int $likeableId, string $likeableType): bool
  {
    return $this->repository->hasLiked($userId, $likeableId, $likeableType);
  }
} 