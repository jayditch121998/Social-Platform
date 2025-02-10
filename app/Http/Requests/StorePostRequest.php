<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required', 'string'],
      'like_count' => ['sometimes', 'integer', 'min:0']
    ];
  }
}