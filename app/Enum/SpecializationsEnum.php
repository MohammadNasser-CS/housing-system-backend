<?php

namespace App\Enum;

enum SpecializationsEnum: string
{
    const MAP =  [
        "كلية الشرف",
        "كلية الدراسات العليا",
        "علوم حياتية",
        "الأحياء بيوتكنولوجيا",
        "الرياضيات",
        "الرياضيات وعلم البيانات",
        "الاحصاء",
        "الفيزياء",
        "فيزياء وفرعي الكترونيات",
        "الكيمياء",
        "كيمياء تطبيقية",
        "اللغة العربية وآدابها",
        "اللغة الإنجليزية وآدابها",
        "الدراسات الامريكية",
        "اللغة الفرنسية",
        "السياحة والآثار",
        "التاريخ",
        "فقه وتشريع",
        "أصول الدين (عام)",
        "شريعة ومصارف إسلامية",
        "معلم المرحلة الأساسية الدنيا",
        "التعليم الجامع والتربية الخاصة",
        "رياض الأطفال",
        "معلم المرحلة الأساسية العليا _ تعليم الرياضيات",
        "معلم المرحلة الأساسية العليا _ تعليم العلوم",
        "معلم المرحلة الأساسية العليا _ تعليم اللغة العربية",
        "معلم المرحلة الأساسية العليا _ تعليم اللغة الانجليزية",
        "معلم المرحلة الأساسية العليا _ تعليم الاجتماعيات",
        "معلم المرحلة الأساسية العليا _ تعليم التكنولوجيا",
        "التربية الرياضية",
        "التدريب الرياضي",
        "التربية الرياضية- التدريب الرياضي",
        "التربية البدنية والصحية",
        "دبلوم التأهيل التربوي",
        "الهندسة المدنية",
        "هندسة الجيوماتيكس",
        "الهندسة المعمارية",
        "هندسة البناء",
        "هندسة التخطيط العمراني",
        "هندسة التخطيط وتكنولوجيا المدن",
        "الهندسة الميكانيكية",
        "الهندسة الكيميائية",
        "الهندسة الصناعية",
        "هندسة الحاسوب",
        "الهندسة الكهربائية",
        "هندسة الاتصالات",
        "هندسة الشبكات والأنظمة الذكية",
        "هندسة الميكاترونكس",
        "هندسة الطاقة والبيئة",
        "هندسة المواد",
        "علم الحاسوب",
        "علم الحاسوب في سوق العمل",
        "أنظمة المعلومات الإدارية",
        "أنظمة المعلومات الحاسوبية",
        "الشبكات وأمن المعلومات",
        "الأمن السيبراني",
        "مسارعلوم طبية حيوية",
        "الطب البشري",
        "استدراكي علوم طبية حيوية",
        "الصيدلة",
        "دكتور صيدلي",
        "البصريات",
        "التمريض",
        "القبالة",
        "العلوم الطبية المخبرية",
        "التصوير الطبي",
        "علوم السمع والنطق",
        "العلاج الطبيعي",
        "التروية القلبية",
        "التخدير والإنعاش التقني",
        "العناية التنفسية",
        "مستحضرات تجميل والعناية بالبشرة",
        "دكتور في طب وجراحة الأسنان",
        "إدارة المعلومات الصحية",
        "صحة الاسنان",
        "تكنولوجيا مختبرات الأسنان",
        "الاقتصاد",
        "العلوم السياسية",
        "العلوم السياسية وإدارة الدولة",
        "الجغرافيا",
        "علم الاجتماع والخدمة الاجتماعية",
        "الخدمة الاجتماعية",
        "علم النفس _ فرعي إرشاد نفسي",
        "الصحافة المكتوبة والالكترونية",
        "الاتصال والاعلام الرقمي",
        "الإذاعة والتلفزيون",
        "صحافة الوسائط المتعددة",
        "العلاقات العامة والاتصال",
        "المحاسبة",
        "إدارة الأعمال",
        "رئيسي ادارة الاعمال / فرعي الريادة و الابتكار",
        "إدارة الأعمال والريادة",
        "العلوم المالية والمصرفية",
        "التكنولوجيا المالية",
        "التسويق",
        "الاتصال والتسويق الرقمي",
        "العقارات",
        "ذكاء الأعمال",
        "الطب البيطري",
        "الإنتاج النباتي والوقاية",
        "الهندسة الزراعية",
        "الإنتاج الحيواني وصحة الحيوان",
        "التغذية والتصنيع الغذائي.",
        "القانون",
        "الموسيقى",
        "التصميم الداخلي (ديكور)",
        "الرسم والتصوير",
        "التصميم الجرافيكي",
        "فن الخزف",
        "تصميم الألعاب",
        "تصميم الأزياء",
        "الفن التعبيري العلاجي",
        "التربية، معلم المرحلة الأساسية الدنيا",
        "التربية، معلم المرحلة الأساسية العليا - تعليم الرياضيات",
        "التربية، معلم المرحلة الأساسية العليا - تعليم العلوم",
        "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة العربية",
        "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة الانجليزية",
        "التربية، معلم المرحلة الأساسية العليا - تعليم الاجتماعيات",
        "التربية، معلم المرحلة الأساسية العليا - تعليم التكنولوجيا",
        "التربية الرياضية - التدريب الرياضي",
        "علم النفس - فرعي إرشاد نفسي",
        "رئيسي الجغرافيا / فرعي جيوماتكس",
    ];
    case honorCollege = "كلية الشرف";
    case graduateStudiesCollege = "كلية الدراسات العليا";
    case lifeSciences = "علوم حياتية";
    case biotechnology = "الأحياء بيوتكنولوجيا";
    case mathematics = "الرياضيات";
    case mathematicsAndDataScience = "الرياضيات وعلم البيانات";
    case statistics = "الاحصاء";
    case physics = "الفيزياء";
    case physicsAndElectronics = "فيزياء وفرعي الكترونيات";
    case chemistry = "الكيمياء";
    case appliedChemistry = "كيمياء تطبيقية";
    case arabicLanguageAndLiterature = "اللغة العربية وآدابها";
    case englishLanguageAndLiterature = "اللغة الإنجليزية وآدابها";
    case americanStudies = "الدراسات الامريكية";
    case frenchLanguage = "اللغة الفرنسية";
    case tourismAndArchaeology = "السياحة والآثار";
    case history = "التاريخ";
    case jurisprudenceAndLegislation = "فقه وتشريع";
    case fundamentalsOfReligion = "أصول الدين (عام)";
    case shariaAndIslamicBanking = "شريعة ومصارف إسلامية";
    case primaryEducation = "معلم المرحلة الأساسية الدنيا";
    case inclusiveEducationAndSpecialEducation = "التعليم الجامع والتربية الخاصة";
    case kindergarten = "رياض الأطفال";
    case upperPrimaryEducationMath = "معلم المرحلة الأساسية العليا _ تعليم الرياضيات";
    case upperPrimaryEducationScience = "معلم المرحلة الأساسية العليا _ تعليم العلوم";
    case upperPrimaryEducationArabic = "معلم المرحلة الأساسية العليا _ تعليم اللغة العربية";
    case upperPrimaryEducationEnglish = "معلم المرحلة الأساسية العليا _ تعليم اللغة الانجليزية";
    case upperPrimaryEducationSocialStudies = "معلم المرحلة الأساسية العليا _ تعليم الاجتماعيات";
    case upperPrimaryEducationTechnology = "معلم المرحلة الأساسية العليا _ تعليم التكنولوجيا";
    case physicalEducation = "التربية الرياضية";
    case sportsTraining = "التدريب الرياضي";
    case physicalEducationAndSportsTraining = "التربية الرياضية- التدريب الرياضي";
    case physicalAndHealthEducation = "التربية البدنية والصحية";
    case educationalQualificationDiploma = "دبلوم التأهيل التربوي";
    case civilEngineering = "الهندسة المدنية";
    case geomaticsEngineering = "هندسة الجيوماتيكس";
    case architecturalEngineering = "الهندسة المعمارية";
    case constructionEngineering = "هندسة البناء";
    case urbanPlanningEngineering = "هندسة التخطيط العمراني";
    case planningAndCityTechnologyEngineering = "هندسة التخطيط وتكنولوجيا المدن";
    case mechanicalEngineering = "الهندسة الميكانيكية";
    case chemicalEngineering = "الهندسة الكيميائية";
    case industrialEngineering = "الهندسة الصناعية";
    case computerEngineering = "هندسة الحاسوب";
    case electricalEngineering = "الهندسة الكهربائية";
    case communicationsEngineering = "هندسة الاتصالات";
    case networksAndSmartSystemsEngineering = "هندسة الشبكات والأنظمة الذكية";
    case mechatronicsEngineering = "هندسة الميكاترونكس";
    case energyAndEnvironmentalEngineering = "هندسة الطاقة والبيئة";
    case materialsEngineering = "هندسة المواد";
    case computerScience = "علم الحاسوب";
    case computerScienceInLaborMarket = "علم الحاسوب في سوق العمل";
    case managementInformationSystems = "أنظمة المعلومات الإدار";
}
