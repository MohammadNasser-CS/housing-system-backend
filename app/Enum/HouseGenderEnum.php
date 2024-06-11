<?php

namespace App\Enum;

enum HouseGenderEnum: string
{
    const MAP = [
        'طلاب',
        'طالبات'
    ];
    case MALE = 'طلاب';
    case FEMALE = 'طالبات';
}
