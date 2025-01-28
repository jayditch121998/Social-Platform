<?php

namespace App\DTOs;

class CommentDTO
{
  public function __construct(
    public readonly ?int $parent_id,
    public readonly int $user_id,
    public readonly int $post_id,
    public readonly string $comment,
    public readonly int $like_count = 0
  ) {
  }

  public static function fromRequest(array $data): self
  {
    return new self(
      parent_id: $data['parent_id'] ?? null,
      user_id: $data['user_id'],
      post_id: $data['post_id'],
      comment: $data['comment'],
      like_count: $data['like_count'] ?? 0
    );
  }
}