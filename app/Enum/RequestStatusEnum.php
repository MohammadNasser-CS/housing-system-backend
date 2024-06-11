<?php

namespace App\Enum;

enum RequestStatusEnum: string
{
    const MAP = [
        'في الإنتظار',
        'تم التأكيد',
        'تم اللقاء',
    ];
    case waiting = 'في الإنتظار';
    case confirmed = 'تم التأكيد';
    case done = 'تم اللقاء';
}
