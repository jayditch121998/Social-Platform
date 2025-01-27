<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$rules = [
			'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
			'username' => ['required', 'string', 'min:3', Rule::unique('users')->ignore($this->user)],
			'last_name' => ['required', 'string', 'max:255'],
			'first_name' => ['required', 'string', 'max:255'],
			'middle_name' => ['nullable', 'string', 'max:255'],
			'is_active' => ['sometimes', 'boolean'],
			'follow_count' => ['sometimes', 'integer'],
		];

		// Add password validation only for new users or if password is being updated
		if ($this->isMethod('POST') || $this->has('password')) {
			$rules['password'] = ['required', 'string', 'min:8'];
		}

		return $rules;
	}
} 