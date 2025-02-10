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
	protected function successResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
	{
		return response()->json([
			'success' => true,
			'message' => $message,
			'data' => $data
		], $code);
	}

	/**
	 * Return error response
	 */
	protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
	{
		return response()->json([
			'success' => false,
			'message' => $message,
			'errors' => $errors
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

	protected function createdResponse($data = null, string $message = 'Created successfully'): JsonResponse
	{
		return $this->successResponse($data, $message, 201);
	}

	protected function deletedResponse(string $message = 'Deleted successfully'): JsonResponse
	{
		return $this->successResponse(null, $message, 204);
	}
}
