<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddHouseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'Description' => 'required',
            'Address' => 'required',
            'Gender' => 'required',
            'Location' => 'required',
        ];
    }
}
