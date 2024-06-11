<?php

namespace App\Enum;

enum SpecializationsEnum: string
{
    const MAP = [
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
        "معلم المرحلة الأساسية العليا _تعليم اللغة الانجليزية",
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
        "العلوم السياسية",
        "العلوم السياسية وإدارة الدولة",
        "الموسيقى",
        "التصميم الداخلي (ديكور)",
        "الرسم والتصوير",
        "التصميم الجرافيكي",
        "فن الخزف",
        "تصميم الألعاب",
        "تصميم الأزياء",
        "الفن التعبيري العلاجي",
        "اللغة العربية وآدابها",
        "اللغة الإنجليزية وآدابها",
        "اللغة الفرنسية",
        "التربية، معلم المرحلة الأساسية الدنيا",
        "التعليم الجامع والتربية الخاصة",
        "رياض الأطفال",
        "التربية، معلم المرحلة الأساسية العليا - تعليم الرياضيات",
        "التربية، معلم المرحلة الأساسية العليا - تعليم العلوم",
        "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة العربية",
        "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة الانجليزية",
        "التربية، معلم المرحلة الأساسية العليا - تعليم الاجتماعيات",
        "التربية، معلم المرحلة الأساسية العليا - تعليم التكنولوجيا",
        "التربية الرياضية",
        "التربية الرياضية - التدريب الرياضي",
        "التربية البدنية والصحية",
        "علم النفس - فرعي إرشاد نفسي",
        "علم الاجتماع والخدمة الاجتماعية",
        "الخدمة الاجتماعية",
        "الجغرافيا",
        "رئيسي الجغرافيا / فرعي جيوماتكس",
        "التاريخ",
        "رئيسي التاريخ / فرعي تربية",
        "السياحة والآثار",
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
    case upperPrimaryEducationEnglish = "معلم المرحلة الأساسية العليا _تعليم اللغة الانجليزية";
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
    case managementInformationSystems = "أنظمة المعلومات الإدارية";
    case computerInformationSystems = "أنظمة المعلومات الحاسوبية";
    case networksAndInformationSecurity = "الشبكات وأمن المعلومات";
    case cybersecurity = "الأمن السيبراني";
    case biomedicalScienceTrack = "مسارعلوم طبية حيوية";
    case medicine = "الطب البشري";
    case remedialBiomedicalSciences = "استدراكي علوم طبية حيوية";
    case pharmacy = "الصيدلة";
    case doctorOfPharmacy = "دكتور صيدلي";
    case optometry = "البصريات";
    case nursing = "التمريض";
    case midwifery = "القبالة";
    case medicalLaboratorySciences = "العلوم الطبية المخبرية";
    case medicalImaging = "التصوير الطبي";
    case audiologyAndSpeechTherapy = "علوم السمع والنطق";
    case physicalTherapy = "العلاج الطبيعي";
    case cardiacPerfusion = "التروية القلبية";
    case anesthesiaAndRecoveryTechnician = "التخدير والإنعاش التقني";
    case respiratoryCare = "العناية التنفسية";
    case cosmeticsAndSkinCare = "مستحضرات تجميل والعناية بالبشرة";
    case doctorOfDentistry = "دكتور في طب وجراحة الأسنان";
    case healthInformationManagement = "إدارة المعلومات الصحية";
    case dentalHealth = "صحة الاسنان";
    case dentalLaboratoryTechnology = "تكنولوجيا مختبرات الأسنان";
    case economics = "الاقتصاد";
    case politicalScience = "العلوم السياسية";
    case politicalScienceAndStateManagement = "العلوم السياسية وإدارة الدولة";
    case geography = "الجغرافيا";
    case sociologyAndSocialWork = "علم الاجتماع والخدمة الاجتماعية";
    case socialWork = "الخدمة الاجتماعية";
    case psychologyWithMinorInCounseling = "علم النفس _ فرعي إرشاد نفسي";
    case printAndElectronicJournalism = "الصحافة المكتوبة والالكترونية";
    case digitalCommunicationAndMedia = "الاتصال والاعلام الرقمي";
    case radioAndTelevision = "الإذاعة والتلفزيون";
    case multimediaJournalism = "صحافة الوسائط المتعددة";
    case publicRelationsAndCommunication = "العلاقات العامة والاتصال";
    case accounting = "المحاسبة";
    case businessAdministration = "إدارة الأعمال";
    case businessAdministrationWithMinorInInnovation = "رئيسي ادارة الاعمال / فرعي الريادة و الابتكار";
    case businessAdministrationAndEntrepreneurship = "إدارة الأعمال والريادة";
    case financialAndBankingSciences = "العلوم المالية والمصرفية";
    case financialTechnology = "التكنولوجيا المالية";
    case marketing = "التسويق";
    case digitalMarketingAndCommunication = "الاتصال والتسويق الرقمي";
    case realEstate = "العقارات";
    case businessIntelligence = "ذكاء الأعمال";
    case veterinaryMedicine = "الطب البيطري";
    case plantProductionAndProtection = "الإنتاج النباتي والوقاية";
    case agriculturalEngineering = "الهندسة الزراعية";
    case animalProductionAndHealth = "الإنتاج الحيواني وصحة الحيوان";
    case nutritionAndFoodProcessing = "التغذية والتصنيع الغذائي";
    case law = "القانون";
    case music = "الموسيقى";
    case interiorDesign = "التصميم الداخلي (ديكور)";
    case drawingAndPainting = "الرسم والتصوير";
    case graphicDesign = "التصميم الجرافيكي";
    case ceramicsArt = "فن الخزف";
    case gameDesign = "تصميم الألعاب";
    case fashionDesign = "تصميم الأزياء";
    case expressiveArtTherapy = "الفن التعبيري العلاجي";
    case arabicLanguageAndLiteratureRevisited = "اللغة العربية وآدابها";
    case englishLanguageAndLiteratureRevisited = "اللغة الإنجليزية وآدابها";
    case frenchLanguageRevisited = "اللغة الفرنسية";
    case educationPrimaryEducation = "التربية، معلم المرحلة الأساسية الدنيا";
    case inclusiveEducationAndSpecialEducationRevisited = "التعليم الجامع والتربية الخاصة";
    case kindergartenRevisited = "رياض الأطفال";
    case educationUpperPrimaryMath = "التربية، معلم المرحلة الأساسية العليا - تعليم الرياضيات";
    case educationUpperPrimaryScience = "التربية، معلم المرحلة الأساسية العليا - تعليم العلوم";
    case educationUpperPrimaryArabic = "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة العربية";
    case educationUpperPrimaryEnglish = "التربية، معلم المرحلة الأساسية العليا - تعليم اللغة الانجليزية";
    case educationUpperPrimarySocialStudies = "التربية، معلم المرحلة الأساسية العليا - تعليم الاجتماعيات";
    case educationUpperPrimaryTechnology = "التربية، معلم المرحلة الأساسية العليا - تعليم التكنولوجيا";
    case physicalEducationRevisited = "التربية الرياضية";
    case physicalEducationAndSportsTrainingRevisited = "التربية الرياضية - التدريب الرياضي";
    case physicalAndHealthEducationRevisited = "التربية البدنية والصحية";
    case psychologyWithMinorInCounselingRevisited = "علم النفس - فرعي إرشاد نفسي";
    case sociologyAndSocialWorkRevisited = "علم الاجتماع والخدمة الاجتماعية";
    case socialWorkRevisited = "الخدمة الاجتماعية";
    case geographyRevisited = "الجغرافيا";
    case geographyWithMinorInGeomatics = "رئيسي الجغرافيا / فرعي جيوماتكس";
    case historyRevisited = "التاريخ";
    case historyWithMinorInEducation = "رئيسي التاريخ / فرعي تربية";
    case tourismAndArchaeologyRevisited = "السياحة والآثار";

}
