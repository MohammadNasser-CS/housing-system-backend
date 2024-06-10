<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequestHouseOwner extends FormRequest
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
            'Name' => 'required|string|max:255',
            'Password' => 'required|string|min:8',
            'Email' => 'required|string|email|max:255|unique:users',
            'Phone' => 'required|string|max:255|unique:users',
            'Gender' => 'required|string|max:255',
            'RoyaltyPhoto' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,svg,webp',
            'TimesList' => 'nullable|string|max:255',
            'DaysList' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'password.min' => 'The password must be at least 8 characters.',
            'phone.unique' => 'The Phone has already been taken',
        ];
    }
}
