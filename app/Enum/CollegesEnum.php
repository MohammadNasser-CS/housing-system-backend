<?php

namespace App\Enum;

enum CollegesEnum: string
{
    const MAP = [
        "كلية الأعمال والإتصال",
        "كلية الدراسات العليا",
        "كلية الزراعة والطب البيطري",
        "كلية الشرف",
        "كلية الشريعة",
        "كلية الطب وعلوم الصحة",
        "كلية العلوم",
        "كلية العلوم الإنسانية والتربوية",
        "كلية الفنون الجميلة",
        "كلية القانون والعلوم السياسية",
        "كلية الهندسة وتكنولوجيا المعلومات",
    ];
    case businessAndCommunicationCollege =  "كلية الأعمال والإتصال";
    case graduateStudiesCollege =  "كلية الدراسات العليا";
    case agricultureAndVeterinaryCollege = "كلية الزراعة والطب البيطري";
    case honorCollege =  "كلية الشرف";
    case sharia =    "كلية الشريعة";
    case medicineAndHealth = "كلية الطب وعلوم الصحة";
    case science =  "كلية العلوم";
    case humanitiesAndEducationalSciences =  "كلية العلوم الإنسانية والتربوية";
    case FineArts = "كلية الفنون الجميلة";
    case LawAndPolitical = "كلية القانون والعلوم السياسية";
    case EngineeringAndIT = "كلية الهندسة وتكنولوجيا المعلومات";
}
