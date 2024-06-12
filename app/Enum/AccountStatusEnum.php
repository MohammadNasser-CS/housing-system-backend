<?php

namespace App\Enum;

enum AccountStatusEnum: string
{
    const MAP = [
        'Active',
        'Not_Active'
    ];
    case active = 'Active';
    case notActive = "Not_Active";
}
