<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'name'   => ['sometimes', 'required', 'string', 'max:255'],
            'email'  => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'phone'  => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'string', 'url', 'max:500'],
        ];
    }
}
