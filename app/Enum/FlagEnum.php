<?php

namespace App\Enum;

enum FlagEnum: string
{
    const MAP = [
        'نعم',
        'لا'
    ];
    case yes = 'نعم';
    case no = 'لا';
}
