<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of users.
	 */
	public function index(): JsonResponse
	{
		return $this->executeAction(function () {
			$users = User::paginate(10);
			return $this->successResponse($users);
		});
	}

	/**
	 * Store a newly created user.
	 */
	public function store(UserRequest $request): JsonResponse
	{
		return $this->executeAction(function () use ($request) {
			$validated = $request->validated();
			$validated['password'] = Hash::make($validated['password']);
			
			$user = User::create($validated);
			
			return $this->successResponse(
				data: ['user' => $user],
				message: 'User created successfully'
			);
		});
	}

	/**
	 * Display the specified user.
	 */
	public function show(User $user): JsonResponse
	{
		return $this->executeAction(function () use ($user) {
			return $this->successResponse($user);
		});
	}

	/**
	 * Update the specified user.
	 */
	public function update(UserRequest $request, User $user): JsonResponse
	{
		return $this->executeAction(function () use ($request, $user) {
			$validated = $request->validated();
			
			if (isset($validated['password'])) {
				$validated['password'] = Hash::make($validated['password']);
			}
			
			$user->update($validated);
			
			return $this->successResponse(
				data: ['user' => $user],
				message: 'User updated successfully'
			);
		});
	}

	/**
	 * Remove the specified user.
	 */
	public function destroy(User $user): JsonResponse
	{
		return $this->executeAction(function () use ($user) {
			$user->delete();
			
			return $this->successResponse(
				data: null,
				message: 'User deleted successfully'
			);
		});
	}
} 