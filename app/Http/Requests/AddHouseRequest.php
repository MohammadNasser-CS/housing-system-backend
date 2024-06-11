<?php

namespace App\Http\Requests;

use App\Enum\HouseGenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddHouseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'description' => 'required',
            'address' => 'required',
            'gender' => ['required',Rule::in(array_values(HouseGenderEnum::MAP))],
            'location' => 'required',
        ];
    }
}
