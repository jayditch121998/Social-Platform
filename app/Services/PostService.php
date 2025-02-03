<?php

namespace App\Services;

use App\DTOs\PostDTO;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
  public function __construct(private PostRepository $repository)
  {
  }

  public function createPost(PostDTO $postDTO): Post
  {
    return $this->repository->create($postDTO);
  }

  public function updatePost(Post $post, PostDTO $postDTO): bool
  {
    return $this->repository->update($post, $postDTO);
  }

  public function deletePost(Post $post): bool
  {
    return $this->repository->delete($post);
  }

  public function getPost(int $id): ?Post
  {
    return $this->repository->findById($id);
  }

  public function getPaginatedPosts(int $perPage = 15): LengthAwarePaginator
  {
    return $this->repository->getPaginated($perPage);
  }

  public function getUserPosts(int $userId): Collection
  {
    return $this->repository->getAllByUser($userId);
  }
}