<?php

namespace App\Http\Controllers;

use App\DTOs\LikeDTO;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function __construct(private LikeService $service)
  {
  }

  public function toggle(Request $request): JsonResponse
  {
    return $this->executeAction(function () use ($request) {
      $validated = $request->validate([
        'likeable_id' => 'required|integer',
        'likeable_type' => 'required|string|in:App\Models\Post,App\Models\Comment'
      ]);

      $validated['user_id'] = auth()->user()->id;
      $liked = $this->service->toggleLike(LikeDTO::fromRequest($validated));

      return $this->successResponse([
        'liked' => $liked,
        'count' => $this->service->getLikeCount(
          $validated['likeable_id'],
          $validated['likeable_type']
        )
      ], 'Like toggled successfully');
    });
  }

  public function status(Request $request): JsonResponse
  {
    return $this->executeAction(function () use ($request) {
      $validated = $request->validate([
        'likeable_id' => 'required|integer',
        'likeable_type' => 'required|string|in:App\Models\Post,App\Models\Comment'
      ]);

      return $this->successResponse([
        'liked' => $this->service->hasLiked(
          auth()->user()->id,
          $validated['likeable_id'],
          $validated['likeable_type']
        ),
        'count' => $this->service->getLikeCount(
          $validated['likeable_id'],
          $validated['likeable_type']
        )
      ]);
    });
  }
} 