<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'Password' => 'required',
            'new_Password' => 'required|string|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'new_Password.min' => 'The new password must be at least 8 characters long.',
        ];
    }
}
