<?php

namespace App\Enum;

enum UserGenderEnum: string
{
    const MAP = [
        'ذكر',
        'أنثى'
    ];
    case MALE = 'ذكر';
    case FEMALE = 'أنثى';
}
