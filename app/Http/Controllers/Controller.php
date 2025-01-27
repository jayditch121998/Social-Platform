<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Throwable;

class Controller extends BaseController
{
	use AuthorizesRequests, ValidatesRequests;

	/**
	 * Return success response
	 */
	protected function successResponse(mixed $data, string $message = '', int $code = 200): JsonResponse
	{
		return response()->json([
			'data' => $data,
			'message' => $message
		], $code);
	}

	/**
	 * Return error response
	 */
	protected function errorResponse(string $message, int $code = 500): JsonResponse
	{
		return response()->json([
			'error' => $message
		], $code);
	}

	/**
	 * Execute action and return standardized response
	 */
	protected function executeAction(callable $action): JsonResponse
	{
		try {
			return $action();
		} catch (Throwable $th) {
			return $this->errorResponse($th->getMessage());
		}
	}
}