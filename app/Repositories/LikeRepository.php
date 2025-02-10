<?php

namespace App\Repositories;

use App\DTOs\LikeDTO;
use App\Models\Like;

class LikeRepository
{
  public function __construct(private Like $model)
  {
  }

  public function toggle(LikeDTO $dto): bool
  {
    $like = $this->model->where([
      'user_id' => $dto->user_id,
      'likeable_id' => $dto->likeable_id,
      'likeable_type' => $dto->likeable_type
    ])->first();

    if ($like) {
      return (bool) $like->delete();
    }

    return (bool) $this->model->create((array) $dto);
  }

  public function getLikeCount(int $likeableId, string $likeableType): int
  {
    return $this->model
      ->where('likeable_id', $likeableId)
      ->where('likeable_type', $likeableType)
      ->count();
  }

  public function hasLiked(int $userId, int $likeableId, string $likeableType): bool
  {
    return $this->model
      ->where('user_id', $userId)
      ->where('likeable_id', $likeableId)
      ->where('likeable_type', $likeableType)
      ->exists();
  }
} 