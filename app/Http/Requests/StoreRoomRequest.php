<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enum\FlagEnum;
use App\Enum\RoomTypeEnum;
class StoreRoomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'houseId' => 'required|exists:houses,id',
            'roomType' => ['required', Rule::in(array_values(RoomTypeEnum::MAP))],
            'bedNumber' => 'required|string',
            'bedNumberBooked' => 'required|string',
            'roomSpace' => 'required|numeric',
            'balcony' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'desk' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'ac' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'price' => 'required|string',
            'photos' => 'required|array|min:1',
            'photos.*.base64Image' => 'required|string',
            'photos.*.imageExtension' => 'required|string',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
