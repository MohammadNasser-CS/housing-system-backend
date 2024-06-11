<?php

namespace App\Enum;

enum HouseTypeEnum: string
{
    const MAP = [
        "شقة",
        "أستوديو",
        "منزل",
    ];
    case Apartment = 'شقة';
    case Studio = 'أستوديو';
    case House = 'منزل';
}
