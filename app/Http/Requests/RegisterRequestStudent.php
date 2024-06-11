<?php

namespace App\Http\Requests;

use App\Enum\CollegesEnum;
use App\Enum\SpecializationsEnum;
use App\Enum\UniversityBuildingsEnum;
use App\Enum\UserGenderEnum;
use App\Enum\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SNMP;

class RegisterRequestStudent extends FormRequest
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
            'role' => ['required', Rule::in(array_values(UserRoleEnum::MAP))],
            'college' => ['required',Rule::in(array_values(CollegesEnum::MAP))],
            'specialization' => ['required',Rule::in(array_values(SpecializationsEnum::MAP))],
            'universityBuilding' => ['required',Rule::in(array_values(UniversityBuildingsEnum::MAP))],
            'birthDate' => 'required|string|max:255',
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
