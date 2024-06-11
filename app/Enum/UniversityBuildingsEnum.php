<?php

namespace App\Enum;

enum UniversityBuildingsEnum: string
{
    const MAP = [
        'الحرم الجديد-الأكاديمية',
        'الحرم القديم',
        'كلية حجاوي',
        'مبنى خضوري',
        'مستشفى الجامعة',
        'روابي',
    ];
    case Academy = 'الحرم الجديد-الأكاديمية';
    case OldHaram = 'الحرم القديم';
    case Hijjawi = 'كلية حجاوي';
    case Khadouri = 'مبنى خضوري';
    case Hospital = 'مستشفى الجامعة';
    case Rawabi = 'روابي';
}
