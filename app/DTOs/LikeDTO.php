<?php

namespace App\DTOs;

class LikeDTO
{
  public function __construct(
    public readonly int $user_id,
    public readonly int $likeable_id,
    public readonly string $likeable_type
  ) {
  }

  public static function fromRequest(array $data): self
  {
    return new self(
      user_id: $data['user_id'],
      likeable_id: $data['likeable_id'],
      likeable_type: $data['likeable_type']
    );
  }
} 