<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    const MAP = [
        'طالب',
        'صاحب سكن',
        'أدمن'
    ];
    case ADMIN = 'أدمن';
    case OWNER = 'صاحب سكن';
    case STUDENT = 'طالب';
}
