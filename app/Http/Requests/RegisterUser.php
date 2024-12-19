<?php

namespace App\Http\Requests;

class RegisterUser extends BaseFormRequest
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
    return [
      'email' => ['required', 'email', 'unique:users,email'],
      'username' => ['required', 'string', 'unique:users,username'],
      'last_name' => ['required', 'string'],
      'first_name' => ['required', 'string'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];
  }
}
