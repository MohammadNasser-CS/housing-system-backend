<?php

namespace App\Http\Requests;

use App\Enum\RoomTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSeconderyRoomRequest extends FormRequest
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
            'houseId' => 'required|exists:houses,id',
            'roomType' => ['required', Rule::in(array_values(RoomTypeEnum::MAP))],
            'base64Image' => 'required|string',
            'imageExtension' => 'required|string',
        ];
    }
}
