<?php

namespace App\Repositories;

use App\DTOs\PostDTO;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
  public function __construct(private Post $model)
  {
  }

  public function create(PostDTO $postDTO): Post
  {
    return $this->model->create((array) $postDTO);
  }

  public function update(Post $post, PostDTO $postDTO): bool
  {
    return $post->update((array) $postDTO);
  }

  public function delete(Post $post): bool
  {
    return $post->delete();
  }

  public function findById(int $id): ?Post
  {
    return $this->model->find($id);
  }

  public function getPaginated(int $perPage = 15): LengthAwarePaginator
  {
    return $this->model->latest()->paginate($perPage);
  }

  public function getAllByUser(int $userId): Collection
  {
    return $this->model->where('user_id', $userId)->latest()->get();
  }
}