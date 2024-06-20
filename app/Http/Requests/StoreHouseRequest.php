<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\FlagEnum;
use App\Enum\HouseGenderEnum;
use App\Enum\HouseTypeEnum;
use App\Enum\UniversityBuildingsEnum;
use Illuminate\Validation\Rule;


class StoreHouseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // تغيير هذه القيمة إلى true للسماح بالتحقق من الطلب
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'houseType' => ['required', Rule::in(array_values(HouseTypeEnum::MAP))],
            'gender' => ['required', Rule::in(array_values(HouseGenderEnum::MAP))],
            'location' => ['required', Rule::in(array_values(UniversityBuildingsEnum::MAP))],
            'internet' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'water' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'electricity' => ['required', Rule::in(array_values(FlagEnum::MAP))],
            'gas' => ['required', Rule::in(array_values(FlagEnum::MAP))],
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'الوصف مطلوب.',
            'address.required' => 'العنوان مطلوب.',
            'houseType.required' => 'نوع البيت مطلوب.',
            'gender.required' => 'الجنس مطلوب.',
            'location.required' => 'الموقع مطلوب.',
            'internet.required' => 'حالة الإنترنت مطلوبة.',
            'water.required' => 'حالة الماء مطلوبة.',
            'electricity.required' => 'حالة الكهرباء مطلوبة.',
            'gas.required' => 'حالة الغاز مطلوبة.',
            'houseType.in' => 'نوع البيت يجب أن يكون إما "شقة" أو "أستوديو".',
            'gender.in' => 'الجنس يجب أن يكون إما "طلاب" أو "طالبات".',
            'internet.in' => 'حالة الإنترنت يجب أن تكون "نعم" أو "لا".',
            'water.in' => 'حالة الماء يجب أن تكون "نعم" أو "لا".',
            'electricity.in' => 'حالة الكهرباء يجب أن تكون "نعم" أو "لا".',
            'gas.in' => 'حالة الغاز يجب أن تكون "نعم" أو "لا".',
        ];
    }
}
