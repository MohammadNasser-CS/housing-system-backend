<?php

namespace App\Http\Requests;

use App\Enum\UserGenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'required|string|max:255|unique:users',
            'gender' => ['required',Rule::in(array_values(UserGenderEnum::MAP))],
            'royaltyPhoto' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,svg,webp',
            'timesList' => 'nullable|string|max:255',
            'daysList' => 'nullable|string|max:255',
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
