<?php

namespace App\DTOs;

class PostDTO
{
  public function __construct(
    public readonly ?int $id,
    public readonly string $title,
    public readonly string $content,
    public readonly int $user_id,
    public readonly int $like_count = 0,
    public readonly ?string $created_at = null,
    public readonly ?string $updated_at = null
  ) {
  }

  public static function fromRequest(array $data): self
  {
    return new self(
      id: $data['id'] ?? null,
      title: $data['title'],
      content: $data['content'],
      user_id: $data['user_id'],
      like_count: $data['like_count'] ?? 0,
      created_at: $data['created_at'] ?? null,
      updated_at: $data['updated_at'] ?? null
    );
  }
}