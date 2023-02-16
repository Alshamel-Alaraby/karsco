<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Branch
        Translation::insert([
            [
                "key" => "branch_create_form",
                "default_en" => "Add new branch",
                "default_ar" => "اضف فرع جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "branch"
            ],
            [
                "key" => "branch_edit_form",
                "default_en" => "Edit branch form",
                "default_ar" => "تعديل نموذج الفرع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "branch"
            ],
            [
                "key" => "branch_name_ar",
                "default_en" => "Branch name (arabic)",
                "default_ar" => "اسم الفرع (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "branch"
            ],
            [
                "key" => "branch_name_en",
                "default_en" => "Branch name (english)",
                "default_ar" => "اسم الفرع (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "branch"
            ],
            [
                "key" => "branch_status",
                "default_en" => "Branch status",
                "default_ar" => "حالة الفرع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "branch"
            ],
        ]);
        //Unit status
        Translation::insert([
            [
                "key" => "unitstatus_create_form",
                "default_en" => "Add new unit status",
                "default_ar" => "اضف حالة وحدة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"
            ],
            [
                "key" => "unitstatus_edit_form",
                "default_en" => "Edit unit status form",
                "default_ar" => "نموذج تعديل حالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"
            ],
            [
                "key" => "unitstatus_name_ar",
                "default_en" => "Unit status name (arabic)",
                "default_ar" => "اسم حالة الوحدة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"
            ],
            [
                "key" => "unitstatus_name_en",
                "default_en" => "Unit status name (english)",
                "default_ar" => "اسم حالة الوحدة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"

            ],
            [
                "key" => "unitstatus_status",
                "default_en" => "Unit status",
                "default_ar" => "حالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"

            ],
            [
                "key" => "unitstatus_default",
                "default_en" => "Unit status default",
                "default_ar" => "الحالة الافتراضية لحالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate unit status"

            ],
        ]);
        //Store
        Translation::insert([
            [
                "key" => "store_create_form",
                "default_en" => "Add new store",
                "default_ar" => "اضف مخزن جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",
            ],
            [
                "key" => "store_edit_form",
                "default_en" => "Edit store form",
                "default_ar" => "تعديل نموذج المخزن",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",
            ],
            [
                "key" => "store_name_ar",
                "default_en" => "Store name (arabic)",
                "default_ar" => "اسم المخزن (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",
            ],
            [
                "key" => "store_name_en",
                "default_en" => "Store name (english)",
                "default_ar" => "اسم المخزن (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",
            ],
            [
                "key" => "store_status",
                "default_en" => "Store status",
                "default_ar" => "حالة المخزن",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",

            ],
            [
                "key" => "branch",
                "default_en" => "Branch name",
                "default_ar" => "اسم الفرع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "store",
            ],
        ]);
        //Screen property
        Translation::insert([
            [
                "key" => "screen_property_create_form",
                "default_en" => "Add new screen property form",
                "default_ar" => "اضف خاصية وشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "screen properties",
            ],
            [
                "key" => "screen_property_edit_form",
                "default_en" => "Edit screen property form",
                "default_ar" => "نموذج تعديل الخاصية والشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "screen properties",

            ],
            [
                "key" => "screen",
                "default_en" => "Screen Name",
                "default_ar" => "اسم الشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "screen properties",

            ],
            [
                "key" => "property",
                "default_en" => "Property name",
                "default_ar" => "اسم الخاصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "screen properties",

            ],
        ]);
        //Tree property
        Translation::insert([
            [
                "key" => "property_create_form",
                "default_en" => "Add new property form",
                "default_ar" => "اضف خاصية جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"
            ],
            [
                "key" => "property_edit_form",
                "default_en" => "Edit property form",
                "default_ar" => "نموذج تعديل الخاصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"
            ],
            [
                "key" => "property_name_ar",
                "default_en" => "Property name (arabic)",
                "default_ar" => "اسم الخاصية (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"

            ],
            [
                "key" => "property_name_en",
                "default_en" => "Property name (english)",
                "default_ar" => "اسم الخاصية (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"
            ],
            [
                "key" => "required",
                "default_en" => "required",
                "default_ar" => "مطلوب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"
            ],
            [
                "key" => "parent",
                "default_en" => "Parent name",
                "default_ar" => "اسم الاب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "tree property"
            ],
        ]);
        //Sales men types
        Translation::insert([
            [
                "key" => "sale_man_type_create_form",
                "default_en" => "Add new sale man type",
                "default_ar" => "اضف نوع رجل مبيعات جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men Type"
            ],
            [
                "key" => "sale_man_type_edit_form",
                "default_en" => "Edit sale man type form",
                "default_ar" => "نموذج تعديل نوع رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men Type"
            ],
            [
                "key" => "sale_man_type_name_ar",
                "default_en" => "Sale man type name (arabic)",
                "default_ar" => "اسم نوع رجل المبيعات (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men Type"
            ],
            [
                "key" => "sale_man_type_name_en",
                "default_en" => "Sale man type name (english)",
                "default_ar" => "اسم نوع رجل المبيعات (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men Type"
            ],
            [
                "key" => "is_employee",
                "default_en" => "Is employee",
                "default_ar" => "هل موظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men Type"
            ],
        ]);
        //Sales man
        Translation::insert([
            [
                "key" => "sale_man_create_form",
                "default_en" => "Add new sale man",
                "default_ar" => "اضف رجل مبيعات جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_edit_form",
                "default_en" => "Edit sale man form",
                "default_ar" => "نموذج تعديل رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_name_ar",
                "default_en" => "Sale man name (arabic)",
                "default_ar" => "اسم رجل المبيعات (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_name_en",
                "default_en" => "Sale man name (english)",
                "default_ar" => "اسم رجل المبيعات (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_type",
                "default_en" => "Sale man type",
                "default_ar" => "نوع رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
        ]);
        //External sale man
        Translation::insert([
            [
                "key" => "external_sale_man_create_form",
                "default_en" => "Add new external sale man",
                "default_ar" => "اضف رجل مبيعات خارجي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"
            ],
            [
                "key" => "external_sale_man_edit_form",
                "default_en" => "Edit external sale man form",
                "default_ar" => "نموذج تعديل رجل مبيعات خارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"
            ],
            [
                "key" => "external_sale_man_phone",
                "default_en" => "External Sale man phone",
                "default_ar" => "هاتف رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"
            ],
            [
                "key" => "external_sale_man_email",
                "default_en" => "External Sale man email",
                "default_ar" => "البريد الالكتروني لرجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"
            ],
            [
                "key" => "external_sale_man_national_id",
                "default_en" => "External Sale man national id",
                "default_ar" => "الرقم القومي لرجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"

            ],
            [
                "key" => "external_sale_man_address",
                "default_en" => "External Sale man address",
                "default_ar" => "عنوان رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"

            ],
            [
                "key" => "external_sale_man_code",
                "default_en" => "External Sale man code",
                "default_ar" => "كود رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"

            ],
            [
                "key" => "external_sale_man_status",
                "default_en" => "External Sale man status",
                "default_ar" => "حالة رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "external salesmen"

            ],
        ]);
        //Payment type
        Translation::insert([
            [
                "key" => "payment_type_create_form",
                "default_en" => "Add new payment type",
                "default_ar" => "اضف نوع دفع جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment types"
            ],
            [
                "key" => "payment_type_edit_form",
                "default_en" => "Edit payment type form",
                "default_ar" => " نموذج تعديل نوع الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment types"
            ],
            [
                "key" => "payment_type_name_ar",
                "default_en" => "Payment type name (arabic)",
                "default_ar" => "اسم نوع الدفع (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment types"

            ],
            [
                "key" => "payment_type_name_en",
                "default_en" => "Payment type name (english)",
                "default_ar" => "اسم نوع الدفع (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment types"

            ],
            [
                "key" => "payment_type_default",
                "default_en" => "Payment type default",
                "default_ar" => "الحالة الافتراضية لنوع الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment types"

            ],
        ]);
        //Banks
        Translation::insert([
            [
                "key" => "bank_create_form",
                "default_en" => "Add new bank",
                "default_ar" => "اضف نوع بنك جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"
            ],
            [
                "key" => "bank_edit_form",
                "default_en" => "Edit bank form",
                "default_ar" => " نموذج تعديل البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"
            ],
            [
                "key" => "bank_name_ar",
                "default_en" => "Bank name (arabic)",
                "default_ar" => "اسم البنك (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"
            ],
            [
                "key" => "bank_name_en",
                "default_en" => "Bank name (english)",
                "default_ar" => "اسم البنك (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"

            ],
            [
                "key" => "country",
                "default_en" => "Coutnry name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"

            ],
            [
                "key" => "bank_swiftcode",
                "default_en" => "Bank swiftcode",
                "default_ar" => "سويفت كود البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "banks"
            ],
        ]);
        //Bank account
        Translation::insert([
            [
                "key" => "bank_account_create_form",
                "default_en" => "Add new bank account",
                "default_ar" => "اضف حساب بنكي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_edit_form",
                "default_en" => "Edit bank bank form",
                "default_ar" => " نموذج تعديل الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank",
                "default_en" => "Bank name",
                "default_ar" => "اسم البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_number",
                "default_en" => "Bank account number",
                "default_ar" => "رقم الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_phone",
                "default_en" => "Bank account phone",
                "default_ar" => "هاتف الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_address",
                "default_en" => "Bank account address",
                "default_ar" => "عنوان الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_email",
                "default_en" => "Bank account email",
                "default_ar" => "البريد الالكتروني للحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],

            [
                "key" => "employee",
                "default_en" => "Employee name",
                "default_ar" => "اسم الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
            [
                "key" => "bank_account_rpcode",
                "default_en" => "Bank account rpcode",
                "default_ar" => "ار بي كود الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank accounts"
            ],
        ]);

        //Internal sale man
        Translation::insert([
            [
                "key" => "internal_sale_man_create_form",
                "default_en" => "Add new internal sale man",
                "default_ar" => "اضف رجل مبيعات داخلي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "internal salesmen"
            ],
            [
                "key" => "internal_sale_man_edit_form",
                "default_en" => "Edit internal sale man form",
                "default_ar" => "نموذج تعديل رجل مبيعات داخلي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "internal salesmen"
            ],
            [
                "key" => "employee",
                "default_en" => "Employee name",
                "default_ar" => "اسم الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "internal salesmen"
            ],
            [
                "key" => "internal_sale_man_status",
                "default_en" => "Internal sale man status",
                "default_ar" => "حالة رجل المبيعات الداخلي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "internal salesmen"
            ],
        ]);
        //country
        Translation::insert([
            [
                "key" => "country_create_form",
                "default_en" => "Add new country",
                "default_ar" => "اضف دولة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_edit_form",
                "default_en" => "Edit country form",
                "default_ar" => "نموذج تعديل الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_name_ar",
                "default_en" => "Country name (arabic)",
                "default_ar" => "اسم الدولة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_name_en",
                "default_en" => "Country name (english)",
                "default_ar" => "اسم الدولة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_long_name_ar",
                "default_en" => "Country long name (arabic)",
                "default_ar" => "اسم الدولة طويل (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_long_name_en",
                "default_en" => "Country long name (english)",
                "default_ar" => "اسم الدولة طويل (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_phone_key",
                "default_en" => "Country phone key",
                "default_ar" => "كود هاتف الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_short_code",
                "default_en" => "Country short code",
                "default_ar" => "الكود المختصر للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_default",
                "default_en" => "Country default",
                "default_ar" => "الحالة الافتراضية للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_status",
                "default_en" => "Country status",
                "default_ar" => "حالة الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
            [
                "key" => "country_national_id",
                "default_en" => "Country national id",
                "default_ar" => "الرقم القومي للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "country"
            ],
        ]);
        //governorate
        Translation::insert([
            [
                "key" => "governorate_create_form",
                "default_en" => "Add new governorate",
                "default_ar" => "اضف محافظة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_edit_form",
                "default_en" => "Edit governorate form",
                "default_ar" => "نموذج تعديل المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_name_ar",
                "default_en" => "Governorate name (arabic)",
                "default_ar" => "اسم المحافظة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_name_en",
                "default_en" => "Governorate name (english)",
                "default_ar" => "اسم المحافظة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_phone_key",
                "default_en" => "Governorate phone key",
                "default_ar" => "كود هاتف المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_default",
                "default_en" => "Governorate default",
                "default_ar" => "الحالة الافتراضية للمحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "governorate_status",
                "default_en" => "Governorate status",
                "default_ar" => "حالة المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "governorate"
            ],
        ]);
        //city
        Translation::insert([
            [
                "key" => "city_create_form",
                "default_en" => "Add new city",
                "default_ar" => "اضف مدينة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "city_edit_form",
                "default_en" => "Edit city form",
                "default_ar" => "نموذج تعديل المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "city_name_ar",
                "default_en" => "City name (arabic)",
                "default_ar" => "اسم المدينة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "city_name_en",
                "default_en" => "City name (english)",
                "default_ar" => "اسم المدينة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "city_status",
                "default_en" => "City status",
                "default_ar" => "حالة المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "city"
            ],
        ]);
        //avenue
        Translation::insert([
            [
                "key" => "avenue_create_form",
                "default_en" => "Add new avenue",
                "default_ar" => "اضف منطقة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "avenue_edit_form",
                "default_en" => "Edit avenue form",
                "default_ar" => "نموذج تعديل المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "avenue_name_ar",
                "default_en" => "Avenue name (arabic)",
                "default_ar" => "اسم المنطقة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "avenue_name_en",
                "default_en" => "Avenue name (english)",
                "default_ar" => "اسم المنطقة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "avenue_status",
                "default_en" => "Avenue status",
                "default_ar" => "حالة المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "avenue"
            ],
        ]);
        //Role type
        Translation::insert([
            [
                "key" => "role_type_create_form",
                "default_en" => "Add new role type",
                "default_ar" => "اضف نوع دور جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role Type"
            ],
            [
                "key" => "role_type_edit_form",
                "default_en" => "Edit role type form",
                "default_ar" => "نموذج تعديل نوع الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role Type"
            ],
            [
                "key" => "role_type_name_ar",
                "default_en" => "Role type name (arabic)",
                "default_ar" => "اسم نوع الدور (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role Type"
            ],
            [
                "key" => "role_type_name_en",
                "default_en" => "Role type name (english)",
                "default_ar" => "اسم نوع الدور (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role Type"
            ],
        ]);
        //Role
        Translation::insert([
            [
                "key" => "role_create_form",
                "default_en" => "Add new role",
                "default_ar" => "اضف دور جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "roles"
            ],
            [
                "key" => "role_edit_form",
                "default_en" => "Edit role form",
                "default_ar" => "نموذج تعديل الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "roles"
            ],
            [
                "key" => "role_name_ar",
                "default_en" => "Role name (arabic)",
                "default_ar" => "اسم الدور (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "roles"
            ],
            [
                "key" => "role_name_en",
                "default_en" => "Role name (english)",
                "default_ar" => "اسم الدور (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "roles"
            ],
            [
                "key" => "role_type",
                "default_en" => "Role type name",
                "default_ar" => "اسم نوع الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "roles"
            ],
        ]);
        //Role workflow
        Translation::insert([
            [
                "key" => "role_workflow_create_form",
                "default_en" => "Add new role workflow",
                "default_ar" => "اضف دور سير عمل جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow"
            ],
            [
                "key" => "role_workflow_edit_form",
                "default_en" => "Edit role workflow form",
                "default_ar" => "نموذج تعديل دور سير العمل ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow"
            ],
        ]);
        //Role workflow button
        Translation::insert([
            [
                "key" => "role_workflow_button_create_form",
                "default_en" => "Add new role workflow button",
                "default_ar" => "اضف دور سير عمل زر جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow button"
            ],
            [
                "key" => "role_workflow_button_edit_form",
                "default_en" => "Edit role workflow button form",
                "default_ar" => "نموذج تعديل دور سير العمل والزرار ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow button"
            ],
            [
                "key" => "button",
                "default_en" => "Button name",
                "default_ar" => "اسم الزرار",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow button"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow button"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role workflow button"
            ],
        ]);
        //Role hotfield screen
        Translation::insert([
            [
                "key" => "role_hotfield_screen_create_form",
                "default_en" => "Add new role hotfield screen",
                "default_ar" => "اضف الدور مع الحقل والشاشة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role hotfield screen",
            ],
            [
                "key" => "role_hotfield_screen_edit_form",
                "default_en" => "Edit role hotfield screen form",
                "default_ar" => "نموذج تعديل الدور مع الحقل والشاشة ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role hotfield screen",
            ],
            [
                "key" => "hotfield",
                "default_en" => "Hotfield name",
                "default_ar" => "اسم الحقل الساخن",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role hotfield screen",
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role hotfield screen"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role hotfield screen"
            ],
        ]);
        //Workflow hotfield
        Translation::insert([
            [
                "key" => "workflow_hotfield_create_form",
                "default_en" => "Add new workflow hotfield",
                "default_ar" => "اضف سير العمل مع الحقل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Workflow hotfields"
            ],
            [
                "key" => "workflow_hotfield_edit_form",
                "default_en" => "Edit workflow hotfield form",
                "default_ar" => "نموذج تعديل سير العمل والحقل ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Workflow hotfields"
            ],
            [
                "key" => "hotfield",
                "default_en" => "Hotfield name",
                "default_ar" => "اسم الحقل الساخن",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Workflow hotfields",
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Workflow hotfields"
            ],
        ]);
        //Users
        Translation::insert([
            [
                "key" => "user_create_form",
                "default_en" => "Add new user",
                "default_ar" => "اضف مستخدم جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_edit_form",
                "default_en" => "Edit user form",
                "default_ar" => "تعديل نموذج المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_name_ar",
                "default_en" => "User name (arabic)",
                "default_ar" => "اسم المستخدم (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_name_en",
                "default_en" => "User name (english)",
                "default_ar" => "اسم المستخدم (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_status",
                "default_en" => "User status",
                "default_ar" => "حالة المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_email",
                "default_en" => "User email",
                "default_ar" => "البريد الالكتروني للمستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "employee",
                "default_en" => "Employee name",
                "default_ar" => "اسم الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
            [
                "key" => "user_password",
                "default_en" => "User Password",
                "default_ar" => "كلمة مرور المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "users"
            ],
        ]);
        //Currency
        Translation::insert([
            [
                "key" => "currency_create_form",
                "default_en" => "Add new currency",
                "default_ar" => "اضف عملة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"
            ],
            [
                "key" => "currency_edit_form",
                "default_en" => "Edit currency form",
                "default_ar" => "تعديل نموذج العملة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_name_ar",
                "default_en" => "Currency name (arabic)",
                "default_ar" => "اسم العملة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_name_en",
                "default_en" => "Currency name (english)",
                "default_ar" => "اسم العملة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_code_ar",
                "default_en" => "Currency code (arabic)",
                "default_ar" => "كود العملة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_code_en",
                "default_en" => "Currency code (english)",
                "default_ar" => "كود العملة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_fraction_ar",
                "default_en" => "Currency fraction (arabic)",
                "default_ar" => "كسر العملة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_fraction_en",
                "default_en" => "Currency fraction (english)",
                "default_ar" => "كسر العملة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_symbol_ar",
                "default_en" => "Currency symbol (arabic)",
                "default_ar" => "رمز العملة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"
            ],
            [
                "key" => "currency_symbol_en",
                "default_en" => "Currency symbol (english)",
                "default_ar" => "رمز العملة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_status",
                "default_en" => "Currency status",
                "default_ar" => "حالة العملة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_default",
                "default_en" => "Currency default",
                "default_ar" => "الحالة الافتراضية للعملة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
            [
                "key" => "currency_fraction_number",
                "default_en" => "Currency fraction number",
                "default_ar" => "رقم كسر العملة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "currencies"

            ],
        ]);
        //Employee
        Translation::insert([
            [
                "key" => "employee_create_form",
                "default_en" => "Add new employee",
                "default_ar" => "اضف موظف جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "employees"
            ],
            [
                "key" => "employee_edit_form",
                "default_en" => "Edit employee form",
                "default_ar" => "تعديل نموذج الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "employees"

            ],
            [
                "key" => "employee_name_ar",
                "default_en" => "Employee name (arabic)",
                "default_ar" => "اسم الموظف (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "employees"

            ],
            [
                "key" => "employee_name_en",
                "default_en" => "Employee name (english)",
                "default_ar" => "اسم الموظف (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "employees"

            ],
        ]);
        //Financial Year
        Translation::insert([
            [
                "key" => "financial_year_create_form",
                "default_en" => "Add new financial year",
                "default_ar" => "اضف سنة مالية جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"
            ],
            [
                "key" => "financial_year_edit_form",
                "default_en" => "Edit financial year form",
                "default_ar" => "تعديل نموذج السنة المالية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"

            ],
            [
                "key" => "financial_year_name_ar",
                "default_en" => "Financial year name (arabic)",
                "default_ar" => "اسم السنة المالية (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"

            ],
            [
                "key" => "financial_year_name_en",
                "default_en" => "Financial year name (english)",
                "default_ar" => "اسم السنة المالية (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"

            ],
            [
                "key" => "financial_year_start_date",
                "default_en" => "Financial year start date",
                "default_ar" => "بداية تاريخ السنة المالية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"

            ],
            [
                "key" => "financial_year_end_date",
                "default_en" => "Financial year end date",
                "default_ar" => "نهاية تاريخ السنة المالية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "financial Year"

            ],
        ]);
        //Units
        Translation::insert([
            [
                "key" => "unit_create_form",
                "default_en" => "Add new unit",
                "default_ar" => "اضف وحدة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "units"
            ],
            [
                "key" => "unit_edit_form",
                "default_en" => "Edit unit form",
                "default_ar" => "نموذج تعديل الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "units"

            ],
            [
                "key" => "unit_name_ar",
                "default_en" => "Unit name (arabic)",
                "default_ar" => "اسم الوحدة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "units"

            ],
            [
                "key" => "unit_name_en",
                "default_en" => "Unit name (english)",
                "default_ar" => "اسم الوحدة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "units"

            ],
            [
                "key" => "unit_status",
                "default_en" => "Unit status",
                "default_ar" => "حالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "units"

            ],
        ]);
        //Color
        Translation::insert([
            [
                "key" => "color_create_form",
                "default_en" => "Add new color",
                "default_ar" => "اضف لون جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "color"
            ],
            [
                "key" => "color_edit_form",
                "default_en" => "Edit color form",
                "default_ar" => "نموذج تعديل اللون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "color"

            ],
            [
                "key" => "color_name_ar",
                "default_en" => "Color name (arabic)",
                "default_ar" => "اسم اللون (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "color"

            ],
            [
                "key" => "color_name_en",
                "default_en" => "Color name (english)",
                "default_ar" => "اسم اللون (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "color"

            ],
            [
                "key" => "color_status",
                "default_en" => "Color status",
                "default_ar" => "حالة اللون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "color"

            ],
        ]);
        //Contract unit
        Translation::insert([
            [
                "key" => "contractunit_create_form",
                "default_en" => "Add new contract unit form",
                "default_ar" => "اضف وحدة عقد جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract unit"
            ],
            [
                "key" => "contractunit_edit_form",
                "default_en" => "Edit contract unit form",
                "default_ar" => "نموذج تعديل وحدة عقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract unit"

            ],
        ]);
        //Contract
        Translation::insert([
            [
                "key" => "contract_create_form",
                "default_en" => "Add new contract",
                "default_ar" => "اضف عقد جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"
            ],
            [
                "key" => "contract_edit_form",
                "default_en" => "Edit contract form",
                "default_ar" => "تعديل نموذج العقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"

            ],
            [
                "key" => "customer",
                "default_en" => "Customer name",
                "default_ar" => "اسم الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"
            ],
            [
                "key" => "contract_date",
                "default_en" => "Contract date",
                "default_ar" => "تاريخ العقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"
            ],
            [
                "key" => "sale_man",
                "default_en" => "Sale man name",
                "default_ar" => "اسم رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"

            ],
            [
                "key" => "reservation_date",
                "default_en" => "Reservation date",
                "default_ar" => "تاريخ الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "contract"

            ],
        ]);
        //real estate units
        Translation::insert([
            [
                "key" => "realEstate_unit_create_form",
                "default_en" => "Add New Unit",
                "default_ar" => "اضف وحده جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"
            ],
            [
                "key" => "realEstate_unit_edit_form",
                "default_en" => "Edit color form",
                "default_ar" => "نموذج تعديل الوحده",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_name_ar",
                "default_en" => "Unit Name (arabic)",
                "default_ar" => "اسم وحده (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_name_en",
                "default_en" => "Unit Name (english)",
                "default_ar" => "اسم وحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_description_ar",
                "default_en" => "Unit Description (arabic)",
                "default_ar" => "وصف  الوحده (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_description_en",
                "default_en" => "Unit Description (english)",
                "default_ar" => "وصف الوحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_code",
                "default_en" => "Unit Code",
                "default_ar" => "كود الوحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_unit_ty",
                "default_en" => "Unit Ty (realEstate)",
                "default_ar" => "Unit Ty",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_status_date",
                "default_en" => "Status Date (realEstate)",
                "default_ar" => "وقت الحاله",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_unit_area",
                "default_en" => "Unit Area (realEstate)",
                "default_ar" => "مساحه الوحده",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_building",
                "default_en" => "Unit building (realEstate)",
                "default_ar" => "وحده المبنا (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_owner",
                "default_en" => "Unit Owner (realEstate)",
                "default_ar" => "مالك المبني (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_currency",
                "default_en" => "Unit Currency (realEstate)",
                "default_ar" => "عمله الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_wallet",
                "default_en" => "Unit wallet (realEstate)",
                "default_ar" => "محفظه الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_wallet",
                "default_en" => "Unit wallet (realEstate)",
                "default_ar" => "محفظه الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_status",
                "default_en" => "Unit Status (realEstate)",
                "default_ar" => "حاله الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_price",
                "default_en" => "price (realEstate)",
                "default_ar" => "سعر (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_commission_ty",
                "default_en" => "Commission ty (realEstate)",
                "default_ar" => "Commission Ty (realEstate)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_commission_value",
                "default_en" => "Commission Value (realEstate)",
                "default_ar" => "قيمة العموله (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_commission_ty",
                "default_en" => "Commission ty (realEstate)",
                "default_ar" => "Commission Ty",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_rooms",
                "default_en" => "Rooms (realEstate)",
                "default_ar" => "الغرف (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_path",
                "default_en" => "Path (realEstate)",
                "default_ar" => "حمام (عقارات) ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_floor",
                "default_en" => "Floor (realEstate)",
                "default_ar" => "الارضيه (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_view",
                "default_en" => "View (realEstate)",
                "default_ar" => "View (realEstate)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_rank",
                "default_en" => "Rank (realEstate)",
                "default_ar" => "مرتبه (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ],
            [
                "key" => "realEstate_unit_module",
                "default_en" => "Module (realEstate)",
                "default_ar" => "موديول (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "realEstate units"

            ]
        ]);
        //Owners
        Translation::insert([
            [
                "key" => "owner_create_form",
                "default_en" => "Add new owner",
                "default_ar" => "اضف مالك جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"
            ],
            [
                "key" => "owner_edit_form",
                "default_en" => "Edit owner form",
                "default_ar" => "نموذج تعديل المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_name_ar",
                "default_en" => "Owner name (arabic)",
                "default_ar" => "اسم المالك (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_name_en",
                "default_en" => "Owner name (english)",
                "default_ar" => "اسم المالك (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_phone",
                "default_en" => "Owner phone",
                "default_ar" => "هاتف المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_email",
                "default_en" => "Owner email",
                "default_ar" => "بريد الكترون المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_nationality",
                "default_en" => "Owner nationality",
                "default_ar" => "جنسية المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_national_id",
                "default_en" => "Owner national id",
                "default_ar" => "الرقم القومي للمالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_contact_person",
                "default_en" => "Owner contact person",
                "default_ar" => "معلومات المالك الشخصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_contact_phones",
                "default_en" => "Owner contact phones",
                "default_ar" => "هواتف اتصال المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "bank_account",
                "default_en" => "Bank account name",
                "default_ar" => "اسم الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_whatsapp",
                "default_en" => "Owner whatsapp",
                "default_ar" => "رقم واتساب المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
            [
                "key" => "owner_code",
                "default_en" => "Owner code",
                "default_ar" => "كود المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "owners"

            ],
        ]);
        //Buildings
        Translation::insert([
            [
                "key" => "building_create_form",
                "default_en" => "Add new building",
                "default_ar" => "اضف بناء جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"
            ],
            [
                "key" => "building_edit_form",
                "default_en" => "Edit building form",
                "default_ar" => "نموذج تعديل البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_name_ar",
                "default_en" => "Building name (arabic)",
                "default_ar" => "اسم البناء (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_name_en",
                "default_en" => "Building name (english)",
                "default_ar" => "اسم البناء (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_description_ar",
                "default_en" => "Building description (arabic)",
                "default_ar" => "وصف البناء (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_description_en",
                "default_en" => "Building description (english)",
                "default_ar" => "وصف البناء (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_area",
                "default_en" => "Building area (m)",
                "default_ar" => "مساحة البناء (متر)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_land_area",
                "default_en" => "Building land area (m)",
                "default_ar" => "مساحةارض البناء (متر)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_construction_year",
                "default_en" => "Building construction year",
                "default_ar" => "سنة تاسيس البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "module",
                "default_en" => "Module name",
                "default_ar" => "اسم الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"
            ],

            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],

            [
                "key" => "avenue",
                "default_en" => "Avenue name",
                "default_ar" => "اسم المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_longitude",
                "default_en" => "Building longitude",
                "default_ar" => "خطوط طول المبنى",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
            [
                "key" => "building_latitude",
                "default_en" => "Building latitude",
                "default_ar" => "خطوط عرض المبنى",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "building"

            ],
        ]);
        //Customers
        Translation::insert([
            [
                "key" => "customer_create_form",
                "default_en" => "Add new customer",
                "default_ar" => "اضف زبون جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"
            ],
            [
                "key" => "customer_edit_form",
                "default_en" => "Edit customer form",
                "default_ar" => "نموذج تعديل الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_name_ar",
                "default_en" => "Customer name (arabic)",
                "default_ar" => "اسم الزبون (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_name_en",
                "default_en" => "Customer name (english)",
                "default_ar" => "اسم الزبون (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_phone",
                "default_en" => "Customer phone",
                "default_ar" => "هاتف الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_email",
                "default_en" => "Customer email",
                "default_ar" => "بريد الزبون الالكتروني",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_nationality",
                "default_en" => "Customer nationality",
                "default_ar" => "جنسية الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_national_id",
                "default_en" => "Customer national id",
                "default_ar" => "الرقم القومي للزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_contact_person",
                "default_en" => "Customer contact person",
                "default_ar" => "معلومات الزبون الشخصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_contact_phones",
                "default_en" => "Customer contact phones",
                "default_ar" => "هواتف اتصال الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_whatsapp",
                "default_en" => "Customer whatsapp",
                "default_ar" => "رقم واتساب الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_code",
                "default_en" => "Customer code",
                "default_ar" => "كود الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
            [
                "key" => "customer_passport_number",
                "default_en" => "Customer passport number",
                "default_ar" => "رقم جواز سفر الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "customer"

            ],
        ]);
        //reservation
        Translation::insert([
            [
                "key" => "reservation_create_form",
                "default_en" => "Add new reservation",
                "default_ar" => "اضف حجز جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "reservation_edit_form",
                "default_en" => "Edit reservation form",
                "default_ar" => "تعديل نموذج الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "reservation_date",
                "default_en" => "Reservation date",
                "default_ar" => "تاريخ الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "customer",
                "default_en" => "Customer name",
                "default_ar" => "اسم الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "sale_man",
                "default_en" => "Sale man name",
                "default_ar" => "اسم رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "payment_plan",
                "default_en" => "Payment Plan",
                "default_ar" => "خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
        ]);
        //Building wallet
        Translation::insert([
            [
                "key" => "building_wallet_create_form",
                "default_en" => "Add new building wallet",
                "default_ar" => "اضافة محفظة بناء جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "building_wallet_edit_form",
                "default_en" => "Edit building wallet form",
                "default_ar" => "نموذج تعديل محفظة البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "building",
                "default_en" => "Building name",
                "default_ar" => "اسم البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "wallet",
                "default_en" => "Wallet name",
                "default_ar" => "اسم المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ],
            [
                "key" => "building_wallet_bu_ty",
                "default_en" => "Buty",
                "default_ar" => "الزبد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
            ]
        ]);
        //Wallet
        Translation::insert([
            [
                "key" => "wallet_create_form",
                "default_en" => "Add new wallet",
                "default_ar" => "اضافة محفظة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallets"
            ],
            [
                "key" => "wallet_edit_form",
                "default_en" => "Edit wallet form",
                "default_ar" => "نموذج تعديل محفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallets"

            ],
            [
                "key" => "wallet_name_ar",
                "default_en" => "Wallet name (arabic)",
                "default_ar" => "اسم المحفظة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallets"
            ],
            [
                "key" => "wallet_name_en",
                "default_en" => "Wallet name (english)",
                "default_ar" => "اسم المحفظة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallets"

            ],
        ]);
        //Wallet owner
        Translation::insert([
            [
                "key" => "wallet_owner_create_form",
                "default_en" => "Add new wallet owner",
                "default_ar" => "اضافة محفظة مالك جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallet owner"
            ],
            [
                "key" => "wallet_owner_edit_form",
                "default_en" => "Edit wallet owner form",
                "default_ar" => "نموذج تعديل محفظة المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallet owner"
            ],
            [
                "key" => "wallet",
                "default_en" => "Wallet name",
                "default_ar" => "اسم المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallet owner"
            ],
            [
                "key" => "owner",
                "default_en" => "Owner name",
                "default_ar" => "اسم المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallet owner"
            ],
            [
                "key" => "wallet_owner_percentage",
                "default_en" => "Wallet owner percentage",
                "default_ar" => "النسبة المئوية لمالك المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "wallet owner"
            ],
        ]);
        //sub contact group
        Translation::insert([
            [
                "key" => "subcontact_group_create_form",
                "default_en" => "Add new sub contact group",
                "default_ar" => "اضف جروب تواصل فرعي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
            [
                "key" => "subcontact_group_edit_form",
                "default_en" => "Edit sub contact group form",
                "default_ar" => "نموذج تعديل جروب التواصل الفرعي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
            [
                "key" => "subcontact_group_name_ar",
                "default_en" => "sub contact group name (arabic)",
                "default_ar" => "اسم جروب التواصل الفرعي (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
            [
                "key" => "subcontact_group_name_en",
                "default_en" => "sub contact group name (english)",
                "default_ar" => "اسم جروب التواصل الفرعي (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
            [
                "key" => "main_contact_group",
                "default_en" => "Main contact group name ",
                "default_ar" => "اسم جروب التواصل الاساسي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
            [
                "key" => "gl_coa_acc",
                "default_en" => "GL Coa account",
                "default_ar" => "اسم الحساب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sub contact group"
            ],
        ]);
        //Payment plan installment
        Translation::insert([
            [
                "key" => "payment_plan_installment_create_form",
                "default_en" => "Add new payment plan installment",
                "default_ar" => "إضافة خطة دفع جديدة بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "payment_plan_installment_edit_form",
                "default_en" => "Edit payment plan installment form",
                "default_ar" => "نموذج تعديل التقسيط لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_payment_plan",
                "default_en" => "installment payment plan name",
                "default_ar" => "اسم خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_payment_plan_detail",
                "default_en" => "Installment payment plan detail",
                "default_ar" => "تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_payment_plan_v_date",
                "default_en" => "Installment payment plan v-date",
                "default_ar" => "التاريخ الخامس لتفاصيل خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],

            [
                "key" => "installment_payment_plan_due_date",
                "default_en" => "Installment payment plan due date",
                "default_ar" => "تاريخ استحقاق خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_payment_plan_total_amount",
                "default_en" => "Installment payment plan total amount",
                "default_ar" => "المبلغ الاجمالي لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_payment_plan_paid_amount",
                "default_en" => "Installment payment plan paid amount",
                "default_ar" => "المبلغ المدفوع لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "installment_status",
                "default_en" => "Installment status name",
                "default_ar" => "اسم حالة التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "doc_type",
                "default_en" => "Document type name",
                "default_ar" => "اسم نوع الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "module",
                "default_en" => "Module name",
                "default_ar" => "اسم الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            // [
            //     "key" => "screen",
            //     "default_en" => "Screen name",
            //     "default_ar" => "اسم الشاشة",
            //     "new_ar" => "",
            //     "new_en" => "",
            //     "company_id" => 0,
            //     "screen" => "payment plan installment"
            // ],
            [
                "key" => "ref_id",
                "default_en" => "Ref ID",
                "default_ar" => "رقم الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
            [
                "key" => "rp_code",
                "default_en" => "rp code",
                "default_ar" => "ترميز rp",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "payment plan installment"
            ],
        ]);
        //Installment Status
        Translation::insert([
            [
                "key" => "installment_status_create_form",
                "default_en" => "Add new Installment Status",
                "default_ar" => "اضافة حاله تقسيط جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_status_edit_form",
                "default_en" => "Edit  Installment Status",
                "default_ar" => "نموذج تعديل حاله التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_status_name",
                "default_en" => "Installment Status name (arabic)",
                "default_ar" => "اسم حاله التقسيط (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_status_name_e",
                "default_en" => "installment_status name (english)",
                "default_ar" => "اسم حاله التقسيط (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_status_default",
                "default_en" => "Installment Status Default",
                "default_ar" => "الحالة الافتراضية لحاله التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
        ]);
        //Installment Payment Type
        Translation::insert([
            [
                "key" => "installment_payment_type_create_form",
                "default_en" => "Add new Installment Payment Type",
                "default_ar" => "اضافة نوع دفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_payment_type_edit_form",
                "default_en" => "Edit  Installment Payment Type",
                "default_ar" => "نموذج تعديل نوع الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_payment_type_name",
                "default_en" => "Installment Payment Type name (arabic)",
                "default_ar" => "اسم نوع دفع بالتقسيط (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_payment_type_name_e",
                "default_en" => "Installment Payment Type name (english)",
                "default_ar" => "اسم نوع دفع بالتقسيط (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_payment_auto_freq",
                "default_en" => "Installment Status Auto Freq",
                "default_ar" => "Installment Status Auto Freq",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ],
            [
                "key" => "installment_payment_is_partially",
                "default_en" => "Installment Payment Partially",
                "default_ar" => "Installment Payment Partially",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "installment status"
            ]
        ]);
        //Main Contact Groups
        Translation::insert([
            [
                "key" => "MainContactGroupsCreate",
                "default_en" => "Add new Main Contact Group",
                "default_ar" => "اضافة مجموعة الاتصال الرئيسية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Main Contact Groups"
            ],
            [
                "key" => "MainContactGroupsEdit",
                "default_en" => "Edit Main Contact Group",
                "default_ar" => "نموذج تعديل مجموعة الاتصال الرئيسية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Main Contact Groups"
            ],
            [
                "key" => "Group_name",
                "default_en" => "name Group (arabic)",
                "default_ar" => "اسم المجموعة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Main Contact Groups"
            ],
            [
                "key" => "Group_name_e",
                "default_en" => "name Group (english)",
                "default_ar" => "اسم المجموعة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Main Contact Groups"
            ],
        ]);
        //Installment Payment Plan Detail
        Translation::insert([
            [
                "key" => "InstallmentPaymentPlanDetailCreate",
                "default_en" => "Add new Installment Payment Plan Detail",
                "default_ar" => "اضافة تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "InstallmentPaymentPlanDetailEdit",
                "default_en" => "Edit Installment Payment Plan Detail",
                "default_ar" => "نموذج تعديل تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "installment_payment_type_id",
                "default_en" => "installment payment type",
                "default_ar" => "نوع الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "ln_no",
                "default_en" => "Line No",
                "default_ar" => "رقم الخط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "is_fixed",
                "default_en" => "is fixed",
                "default_ar" => "تم إصلاحه",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "installment_payment_type_per",
                "default_en" => "installment payment type per",
                "default_ar" => "لكل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "installment_payment_type_amount",
                "default_en" => "installment payment type amount",
                "default_ar" => "المبلغ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "installment_payment_type_freq",
                "default_en" => "installment payment type freq",
                "default_ar" => "عدد الاقساط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "interest_per",
                "default_en" => "interest per",
                "default_ar" => "نسبة الفايدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
            [
                "key" => "interest_value",
                "default_en" => "interest value",
                "default_ar" => "قيمة الفايدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "Installment Payment Plan Detail"
            ],
        ]);
        //Archive document
        Translation::insert([
            [
                "key" => "arch_document_create_form",
                "default_en" => "Add new archiving document",
                "default_ar" => "اضف وثيقة ارشفة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
            [
                "key" => "arch_document_edit_form",
                "default_en" => "Edit archiving document form",
                "default_ar" => "نموذج تعديلة وثيقة ارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
            [
                "key" => "arch_document_type",
                "default_en" => "Archiving document type name",
                "default_ar" => "اسم نوع وثيقة الارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
            [
                "key" => "arch_document_status",
                "default_en" => "Archiving document status name",
                "default_ar" => "اسم حالة وثيقة الارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
            [
                "key" => "arch_document_description",
                "default_en" => "Archiving document description",
                "default_ar" => "وصف وثيقة الارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
            [
                "key" => "arch_document_url_reference",
                "default_en" => "Archiving document url reference",
                "default_ar" => "الرابط المرجعي لوثيقة الارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch documents"
            ],
        ]);
        //Arch doc status
        Translation::insert([
            [
                "key" => "arch_document_status_create_form",
                "default_en" => "Add new archiving document status",
                "default_ar" => "اضف حالة وثيقة ارشفة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc status"
            ],
            [
                "key" => "arch_document_status_edit_form",
                "default_en" => "Edit archiving document status form",
                "default_ar" => "نموذج تعديل حالة وثيقة ارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc status"
            ],
            [
                "key" => "arch_document_status_name_ar",
                "default_en" => "Archiving document status name (arabic)",
                "default_ar" => "اسم حالة وثيقة ارشفة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc status"
            ],
            [
                "key" => "arch_document_status_name_en",
                "default_en" => "Archiving document status name (english)",
                "default_ar" => "اسم حالة وثيقة ارشفة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc status"
            ],
        ]);
        //Arch doc type
        Translation::insert([
            [
                "key" => "arch_document_type_create_form",
                "default_en" => "Add new archiving document type",
                "default_ar" => "اضف نوع وثيقة ارشفة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "arch_document_type_edit_form",
                "default_en" => "Edit archiving document type form",
                "default_ar" => "نموذج تعديل نوع وثيقة ارشفة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "arch_document_type_name_ar",
                "default_en" => "Archiving document type name (arabic)",
                "default_ar" => "اسم نوع وثيقة ارشفة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "arch_document_type_name_en",
                "default_en" => "Archiving document type name (english)",
                "default_ar" => "اسم نوع وثيقة ارشفة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "parent",
                "default_en" => "parent name",
                "default_ar" => "اسم الاب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "is_valid",
                "default_en" => "Is valid",
                "default_ar" => "هل صالح",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
        ]);
        //document field
        Translation::insert([
            [
                "key" => "documentFieldName",
                "default_en" => "Document Field Name (arabic)",
                "default_ar" => "اسم حقل المستند (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "documentFieldNameE",
                "default_en" => "Document Field Name (english)",
                "default_ar" => "اسم حقل المستند (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "document-field-type",
                "default_en" => "Document Field type",
                "default_ar" => "نوع حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "document-field-lookup",
                "default_en" => "Document Field Lookup Table",
                "default_ar" => "بحث  حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "document-field-lookup_column",
                "default_en" => "Document Field Lookup Column",
                "default_ar" => "اسم العمود في  حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "document-field-reference",
                "default_en" => "Document Field Reference",
                "default_ar" => "مرجع حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "documentFieldCreate",
                "default_en" => "Add new Document Field",
                "default_ar" => "اضافة مستند جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "property",
                "default_en" => "Property name",
                "default_ar" => "اسم الخاصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
            [
                "key" => "documentFieldEdit",
                "default_en" => "Edit Document Field",
                "default_ar" => "نموذج تعديل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "document field"
            ],
        ]);
        //Arch Department Table
        Translation::insert([
            [
                "key" => "ArchiveDepartmentCreate",
                "default_en" => "Add new Archive Department",
                "default_ar" => "اضافة قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ],
            [
                "key" => "ArchiveDepartmentEdit",
                "default_en" => "Edit Archive Department",
                "default_ar" => "نموذج تعديل قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ],
            [
                "key" => "archive_department_id",
                "default_en" => "Archive Department",
                "default_ar" => "قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ],
            [
                "key" => "archive_name",
                "default_en" => "name (arabic)",
                "default_ar" => "اسم (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ],
            [
                "key" => "archive_name_e",
                "default_en" => "name (english)",
                "default_ar" => "اسم (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ],
            [
                "key" => "archive_status",
                "default_en" => "department status",
                "default_ar" => "حالة القسم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch departments"
            ]
        ]);
        //Arch doc type field Table
        Translation::insert([
            [
                "key" => "arch_doc_type_field_create_form",
                "default_en" => "Add new archiving document type field",
                "default_ar" => "إضافة حقل نوع مستند أرشفة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],
            [
                "key" => "arch_doc_type_field_edit_form",
                "default_en" => "Edit archiving document type field",
                "default_ar" => "تعديل حقل نوع مستند أرشفة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],
            [
                "key" => "arch_doc_type",
                "default_en" => "Archiving document type name",
                "default_ar" => "اسم نوع الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],
            [
                "key" => "arch_doc_field",
                "default_en" => "Archiving document field name",
                "default_ar" => "اسم حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],

            [
                "key" => "arch_doc_field_order",
                "default_en" => "Archiving document Sort field",
                "default_ar" => "ترتيب حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],

            [
                "key" => "arch_doc_field_character",
                "default_en" => "Archiving document field character",
                "default_ar" => "حرف حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],
            [
                "key" => "is_required",
                "default_en" => "Is required",
                "default_ar" => "مطلوب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "arch doc type fields"
            ],
        ]);
        //Archiving
        Translation::insert([
            [
                "key" => "archive_create_form",
                "default_en" => "Add new archiving",
                "default_ar" => "اضافة ارشيف جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "archive_edit_form",
                "default_en" => "Edit archive",
                "default_ar" => "تعديل الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "arch_doc_type",
                "default_en" => "Archiving document type name",
                "default_ar" => "اسم نوع ملف الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "arch_doc_status",
                "default_en" => "Archiving document status name",
                "default_ar" => "اسم حالة ملف الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "archive_file_number",
                "default_en" => "Archive file number",
                "default_ar" => "رقم ملف الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "archive_description",
                "default_en" => "Archive description",
                "default_ar" => "وصف الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
            [
                "key" => "archive_timestamp",
                "default_en" => "Archive timestamp",
                "default_ar" => "تاريخ الارشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving screen"
            ],
        ]);
        //Document Department Table
        Translation::insert([
            [
                "key" => "document_department_create_form",
                "default_en" => "Add new document department",
                "default_ar" => "إضافة قسم للمستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "document_department_edit_form",
                "default_en" => "Edit document department",
                "default_ar" => "تعديل قسم المستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "department",
                "default_en" => "department",
                "default_ar" => "القسم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],
            [
                "key" => "document",
                "default_en" => "document",
                "default_ar" => "المستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "gen arch doc types"
            ],

        ]);

        //Screen property
        Translation::insert([
            [
                "key" => "screen_property_create_form",
                "default_en" => "Add new screen property form",
                "default_ar" => "اضف خاصية وشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties",
            ],
            [
                "key" => "screen_property_edit_form",
                "default_en" => "Edit screen property form",
                "default_ar" => "نموذج تعديل الخاصية والشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties",

            ],
            // [
            //     "key" => "screen",
            //     "default_en" => "Screen Name",
            //     "default_ar" => "اسم الشاشة",
            //     "new_ar" => "",
            //     "new_en" => "",
            //     "company_id" => 0,
            //     "screen" => "properties",

            // ],
            [
                "key" => "property",
                "default_en" => "Property name",
                "default_ar" => "اسم الخاصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties",

            ],
        ]);
        //Tree property
        Translation::insert([
            [
                "key" => "property_create_form",
                "default_en" => "Add new property form",
                "default_ar" => "اضف خاصية جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"
            ],
            [
                "key" => "property_edit_form",
                "default_en" => "Edit property form",
                "default_ar" => "نموذج تعديل الخاصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"
            ],
            [
                "key" => "property_name_ar",
                "default_en" => "Property name (arabic)",
                "default_ar" => "اسم الخاصية (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"

            ],
            [
                "key" => "property_name_en",
                "default_en" => "Property name (english)",
                "default_ar" => "اسم الخاصية (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"
            ],
            [
                "key" => "required",
                "default_en" => "required",
                "default_ar" => "مطلوب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"
            ],
            [
                "key" => "parent",
                "default_en" => "Parent name",
                "default_ar" => "اسم الاب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "properties"
            ],
        ]);

        //Sales men types
        Translation::insert([
            [
                "key" => "sale_man_type_create_form",
                "default_en" => "Add new sale man type",
                "default_ar" => "اضف نوع رجل مبيعات جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_type_edit_form",
                "default_en" => "Edit sale man type form",
                "default_ar" => "نموذج تعديل نوع رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_type_name_ar",
                "default_en" => "Sale man type name (arabic)",
                "default_ar" => "اسم نوع رجل المبيعات (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_type_name_en",
                "default_en" => "Sale man type name (english)",
                "default_ar" => "اسم نوع رجل المبيعات (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "is_employee",
                "default_en" => "Is employee",
                "default_ar" => "هل موظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
        ]);
        //Sales man
        Translation::insert([
            [
                "key" => "sale_man_create_form",
                "default_en" => "Add new sale man",
                "default_ar" => "اضف رجل مبيعات جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_edit_form",
                "default_en" => "Edit sale man form",
                "default_ar" => "نموذج تعديل رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_name_ar",
                "default_en" => "Sale man name (arabic)",
                "default_ar" => "اسم رجل المبيعات (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_name_en",
                "default_en" => "Sale man name (english)",
                "default_ar" => "اسم رجل المبيعات (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "sale_man_type",
                "default_en" => "Sale man type",
                "default_ar" => "نوع رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
        ]);
        //External sale man
        Translation::insert([
            [
                "key" => "external_sale_man_create_form",
                "default_en" => "Add new external sale man",
                "default_ar" => "اضف رجل مبيعات خارجي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "external_sale_man_edit_form",
                "default_en" => "Edit external sale man form",
                "default_ar" => "نموذج تعديل رجل مبيعات خارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "external_sale_man_phone",
                "default_en" => "External Sale man phone",
                "default_ar" => "هاتف رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "external_sale_man_email",
                "default_en" => "External Sale man email",
                "default_ar" => "البريد الالكتروني لرجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "external_sale_man_national_id",
                "default_en" => "External Sale man national id",
                "default_ar" => "الرقم القومي لرجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"

            ],
            [
                "key" => "external_sale_man_address",
                "default_en" => "External Sale man address",
                "default_ar" => "عنوان رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"

            ],
            [
                "key" => "external_sale_man_code",
                "default_en" => "External Sale man code",
                "default_ar" => "كود رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"

            ],
            [
                "key" => "external_sale_man_status",
                "default_en" => "External Sale man status",
                "default_ar" => "حالة رجل المبيعات الخارجي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"

            ],
        ]);
        //Internal sale man
        Translation::insert([
            [
                "key" => "internal_sale_man_create_form",
                "default_en" => "Add new internal sale man",
                "default_ar" => "اضف رجل مبيعات داخلي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "internal_sale_man_edit_form",
                "default_en" => "Edit internal sale man form",
                "default_ar" => "نموذج تعديل رجل مبيعات داخلي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "employee",
                "default_en" => "Employee name",
                "default_ar" => "اسم الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
            [
                "key" => "internal_sale_man_status",
                "default_en" => "Internal sale man status",
                "default_ar" => "حالة رجل المبيعات الداخلي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "sales men"
            ],
        ]);

        //Payment type
        Translation::insert([
            [
                "key" => "payment_type_create_form",
                "default_en" => "Add new payment type",
                "default_ar" => "اضف نوع دفع جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "payment_type_edit_form",
                "default_en" => "Edit payment type form",
                "default_ar" => " نموذج تعديل نوع الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "payment_type_name_ar",
                "default_en" => "Payment type name (arabic)",
                "default_ar" => "اسم نوع الدفع (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"

            ],
            [
                "key" => "payment_type_name_en",
                "default_en" => "Payment type name (english)",
                "default_ar" => "اسم نوع الدفع (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"

            ],
            [
                "key" => "payment_type_default",
                "default_en" => "Payment type default",
                "default_ar" => "الحالة الافتراضية لنوع الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"

            ],
        ]);
        //Banks
        Translation::insert([
            [
                "key" => "bank_create_form",
                "default_en" => "Add new bank",
                "default_ar" => "اضف نوع بنك جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_edit_form",
                "default_en" => "Edit bank form",
                "default_ar" => " نموذج تعديل البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_name_ar",
                "default_en" => "Bank name (arabic)",
                "default_ar" => "اسم البنك (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_name_en",
                "default_en" => "Bank name (english)",
                "default_ar" => "اسم البنك (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"

            ],
            [
                "key" => "country",
                "default_en" => "Coutnry name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"

            ],
            [
                "key" => "bank_swiftcode",
                "default_en" => "Bank swiftcode",
                "default_ar" => "سويفت كود البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
        ]);
        //Bank account
        Translation::insert([
            [
                "key" => "bank_account_create_form",
                "default_en" => "Add new bank account",
                "default_ar" => "اضف حساب بنكي جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_edit_form",
                "default_en" => "Edit bank bank form",
                "default_ar" => " نموذج تعديل الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank",
                "default_en" => "Bank name",
                "default_ar" => "اسم البنك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_number",
                "default_en" => "Bank account number",
                "default_ar" => "رقم الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_phone",
                "default_en" => "Bank account phone",
                "default_ar" => "هاتف الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_address",
                "default_en" => "Bank account address",
                "default_ar" => "عنوان الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_email",
                "default_en" => "Bank account email",
                "default_ar" => "البريد الالكتروني للحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],

            [
                "key" => "employee",
                "default_en" => "Employee name",
                "default_ar" => "اسم الموظف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
            [
                "key" => "bank_account_rpcode",
                "default_en" => "Bank account rpcode",
                "default_ar" => "ار بي كود الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "bank"
            ],
        ]);

        //country
        Translation::insert([
            [
                "key" => "country_create_form",
                "default_en" => "Add new country",
                "default_ar" => "اضف دولة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_edit_form",
                "default_en" => "Edit country form",
                "default_ar" => "نموذج تعديل الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_name_ar",
                "default_en" => "Country name (arabic)",
                "default_ar" => "اسم الدولة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_name_en",
                "default_en" => "Country name (english)",
                "default_ar" => "اسم الدولة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_long_name_ar",
                "default_en" => "Country long name (arabic)",
                "default_ar" => "اسم الدولة طويل (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_long_name_en",
                "default_en" => "Country long name (english)",
                "default_ar" => "اسم الدولة طويل (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_phone_key",
                "default_en" => "Country phone key",
                "default_ar" => "كود هاتف الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_short_code",
                "default_en" => "Country short code",
                "default_ar" => "الكود المختصر للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_default",
                "default_en" => "Country default",
                "default_ar" => "الحالة الافتراضية للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_status",
                "default_en" => "Country status",
                "default_ar" => "حالة الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country_national_id",
                "default_en" => "Country national id",
                "default_ar" => "الرقم القومي للدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
        ]);
        //governorate
        Translation::insert([
            [
                "key" => "governorate_create_form",
                "default_en" => "Add new governorate",
                "default_ar" => "اضف محافظة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_edit_form",
                "default_en" => "Edit governorate form",
                "default_ar" => "نموذج تعديل المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_name_ar",
                "default_en" => "Governorate name (arabic)",
                "default_ar" => "اسم المحافظة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_name_en",
                "default_en" => "Governorate name (english)",
                "default_ar" => "اسم المحافظة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_phone_key",
                "default_en" => "Governorate phone key",
                "default_ar" => "كود هاتف المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_default",
                "default_en" => "Governorate default",
                "default_ar" => "الحالة الافتراضية للمحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate_status",
                "default_en" => "Governorate status",
                "default_ar" => "حالة المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
        ]);
        //city
        Translation::insert([
            [
                "key" => "city_create_form",
                "default_en" => "Add new city",
                "default_ar" => "اضف مدينة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "city_edit_form",
                "default_en" => "Edit city form",
                "default_ar" => "نموذج تعديل المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "city_name_ar",
                "default_en" => "City name (arabic)",
                "default_ar" => "اسم المدينة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "city_name_en",
                "default_en" => "City name (english)",
                "default_ar" => "اسم المدينة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "city_status",
                "default_en" => "City status",
                "default_ar" => "حالة المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
        ]);
        //avenue
        Translation::insert([
            [
                "key" => "avenue_create_form",
                "default_en" => "Add new avenue",
                "default_ar" => "اضف منطقة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "avenue_edit_form",
                "default_en" => "Edit avenue form",
                "default_ar" => "نموذج تعديل المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "avenue_name_ar",
                "default_en" => "Avenue name (arabic)",
                "default_ar" => "اسم المنطقة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "avenue_name_en",
                "default_en" => "Avenue name (english)",
                "default_ar" => "اسم المنطقة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "avenue_status",
                "default_en" => "Avenue status",
                "default_ar" => "حالة المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "area"
            ],
        ]);

        //Role type
        Translation::insert([
            [
                "key" => "role_type_create_form",
                "default_en" => "Add new role type",
                "default_ar" => "اضف نوع دور جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_type_edit_form",
                "default_en" => "Edit role type form",
                "default_ar" => "نموذج تعديل نوع الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_type_name_ar",
                "default_en" => "Role type name (arabic)",
                "default_ar" => "اسم نوع الدور (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_type_name_en",
                "default_en" => "Role type name (english)",
                "default_ar" => "اسم نوع الدور (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);
        //Role
        Translation::insert([
            [
                "key" => "role_create_form",
                "default_en" => "Add new role",
                "default_ar" => "اضف دور جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_edit_form",
                "default_en" => "Edit role form",
                "default_ar" => "نموذج تعديل الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_name_ar",
                "default_en" => "Role name (arabic)",
                "default_ar" => "اسم الدور (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_name_en",
                "default_en" => "Role name (english)",
                "default_ar" => "اسم الدور (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_type",
                "default_en" => "Role type name",
                "default_ar" => "اسم نوع الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);
        //Role workflow
        Translation::insert([
            [
                "key" => "role_workflow_create_form",
                "default_en" => "Add new role workflow",
                "default_ar" => "اضف دور سير عمل جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_workflow_edit_form",
                "default_en" => "Edit role workflow form",
                "default_ar" => "نموذج تعديل دور سير العمل ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);
        //Role workflow button
        Translation::insert([
            [
                "key" => "role_workflow_button_create_form",
                "default_en" => "Add new role workflow button",
                "default_ar" => "اضف دور سير عمل زر جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_workflow_button_edit_form",
                "default_en" => "Edit role workflow button form",
                "default_ar" => "نموذج تعديل دور سير العمل والزرار ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "button",
                "default_en" => "Button name",
                "default_ar" => "اسم الزرار",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);
        //Role hotfield screen
        Translation::insert([
            [
                "key" => "role_hotfield_screen_create_form",
                "default_en" => "Add new role hotfield screen",
                "default_ar" => "اضف الدور مع الحقل والشاشة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role",
            ],
            [
                "key" => "role_hotfield_screen_edit_form",
                "default_en" => "Edit role form",
                "default_ar" => "نموذج تعديل الدور مع الحقل والشاشة ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role",
            ],
            [
                "key" => "hotfield",
                "default_en" => "Hotfield name",
                "default_ar" => "اسم الحقل الساخن",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role",
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "workflow",
                "default_en" => "Workflow name",
                "default_ar" => "اسم سير العمل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);
        //Role user
        Translation::insert([
            [
                "key" => "role_user_create_form",
                "default_en" => "Add new role user",
                "default_ar" => "اضف دور للمستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role_user_edit_form",
                "default_en" => "Edit role user",
                "default_ar" => "تعديل دور المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
            [
                "key" => "user",
                "default_en" => "User name",
                "default_ar" => "اسم المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role"
            ],
        ]);

        //Contract unit
        Translation::insert([
            [
                "key" => "contractunit_create_form",
                "default_en" => "Add new contract unit form",
                "default_ar" => "اضف وحدة عقد جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "contractunit_edit_form",
                "default_en" => "Edit contract unit form",
                "default_ar" => "نموذج تعديل وحدة عقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //Contract
        Translation::insert([
            [
                "key" => "contract_create_form",
                "default_en" => "Add new contract",
                "default_ar" => "اضف عقد جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "contract_edit_form",
                "default_en" => "Edit contract form",
                "default_ar" => "تعديل نموذج العقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer",
                "default_en" => "Customer name",
                "default_ar" => "اسم الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "contract_date",
                "default_en" => "Contract date",
                "default_ar" => "تاريخ العقد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "sale_man",
                "default_en" => "Sale man name",
                "default_ar" => "اسم رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "reservation_date",
                "default_en" => "Reservation date",
                "default_ar" => "تاريخ الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //real estate units
        Translation::insert([
            [
                "key" => "realEstate_unit_create_form",
                "default_en" => "Add New Unit",
                "default_ar" => "اضف وحده جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "realEstate_unit_edit_form",
                "default_en" => "Edit color form",
                "default_ar" => "نموذج تعديل الوحده",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_name_ar",
                "default_en" => "Unit Name (arabic)",
                "default_ar" => "اسم وحده (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_name_en",
                "default_en" => "Unit Name (english)",
                "default_ar" => "اسم وحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_description_ar",
                "default_en" => "Unit Description (arabic)",
                "default_ar" => "وصف  الوحده (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_description_en",
                "default_en" => "Unit Description (english)",
                "default_ar" => "وصف الوحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_code",
                "default_en" => "Unit Code",
                "default_ar" => "كود الوحده (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_unit_ty",
                "default_en" => "Unit Ty (realEstate)",
                "default_ar" => "Unit Ty",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_status_date",
                "default_en" => "Status Date (realEstate)",
                "default_ar" => "وقت الحاله",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_unit_area",
                "default_en" => "Unit Area (realEstate)",
                "default_ar" => "مساحه الوحده",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_building",
                "default_en" => "Unit building (realEstate)",
                "default_ar" => "وحده المبنا (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_owner",
                "default_en" => "Unit Owner (realEstate)",
                "default_ar" => "مالك المبني (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_currency",
                "default_en" => "Unit Currency (realEstate)",
                "default_ar" => "عمله الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_wallet",
                "default_en" => "Unit wallet (realEstate)",
                "default_ar" => "محفظه الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_wallet",
                "default_en" => "Unit wallet (realEstate)",
                "default_ar" => "محفظه الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_status",
                "default_en" => "Unit Status (realEstate)",
                "default_ar" => "حاله الوحده (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_price",
                "default_en" => "price (realEstate)",
                "default_ar" => "سعر (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_commission_ty",
                "default_en" => "Commission ty (realEstate)",
                "default_ar" => "Commission Ty (realEstate)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_commission_value",
                "default_en" => "Commission Value (realEstate)",
                "default_ar" => "قيمة العموله (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_commission_ty",
                "default_en" => "Commission ty (realEstate)",
                "default_ar" => "Commission Ty",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_rooms",
                "default_en" => "Rooms (realEstate)",
                "default_ar" => "الغرف (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_path",
                "default_en" => "Path (realEstate)",
                "default_ar" => "حمام (عقارات) ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_floor",
                "default_en" => "Floor (realEstate)",
                "default_ar" => "الارضيه (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_view",
                "default_en" => "View (realEstate)",
                "default_ar" => "View (realEstate)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_rank",
                "default_en" => "Rank (realEstate)",
                "default_ar" => "مرتبه (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "realEstate_unit_module",
                "default_en" => "Module (realEstate)",
                "default_ar" => "موديول (عقارات)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ]
        ]);
        //Owners
        Translation::insert([
            [
                "key" => "owner_create_form",
                "default_en" => "Add new owner",
                "default_ar" => "اضف مالك جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "owner_edit_form",
                "default_en" => "Edit owner form",
                "default_ar" => "نموذج تعديل المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_name_ar",
                "default_en" => "Owner name (arabic)",
                "default_ar" => "اسم المالك (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_name_en",
                "default_en" => "Owner name (english)",
                "default_ar" => "اسم المالك (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_phone",
                "default_en" => "Owner phone",
                "default_ar" => "هاتف المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_email",
                "default_en" => "Owner email",
                "default_ar" => "بريد الكترون المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_nationality",
                "default_en" => "Owner nationality",
                "default_ar" => "جنسية المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_national_id",
                "default_en" => "Owner national id",
                "default_ar" => "الرقم القومي للمالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_contact_person",
                "default_en" => "Owner contact person",
                "default_ar" => "معلومات المالك الشخصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_contact_phones",
                "default_en" => "Owner contact phones",
                "default_ar" => "هواتف اتصال المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "bank_account",
                "default_en" => "Bank account name",
                "default_ar" => "اسم الحساب البنكي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_whatsapp",
                "default_en" => "Owner whatsapp",
                "default_ar" => "رقم واتساب المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "owner_code",
                "default_en" => "Owner code",
                "default_ar" => "كود المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //Buildings
        Translation::insert([
            [
                "key" => "building_create_form",
                "default_en" => "Add new building",
                "default_ar" => "اضف بناء جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "building_edit_form",
                "default_en" => "Edit building form",
                "default_ar" => "نموذج تعديل البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_name_ar",
                "default_en" => "Building name (arabic)",
                "default_ar" => "اسم البناء (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_name_en",
                "default_en" => "Building name (english)",
                "default_ar" => "اسم البناء (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_description_ar",
                "default_en" => "Building description (arabic)",
                "default_ar" => "وصف البناء (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_description_en",
                "default_en" => "Building description (english)",
                "default_ar" => "وصف البناء (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_area",
                "default_en" => "Building area (m)",
                "default_ar" => "مساحة البناء (متر)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_land_area",
                "default_en" => "Building land area (m)",
                "default_ar" => "مساحةارض البناء (متر)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_construction_year",
                "default_en" => "Building construction year",
                "default_ar" => "سنة تاسيس البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "module",
                "default_en" => "Module name",
                "default_ar" => "اسم الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],

            [
                "key" => "governorate",
                "default_en" => "Governorate name",
                "default_ar" => "اسم المحافظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],

            [
                "key" => "avenue",
                "default_en" => "Avenue name",
                "default_ar" => "اسم المنطقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_longitude",
                "default_en" => "Building longitude",
                "default_ar" => "خطوط طول المبنى",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "building_latitude",
                "default_en" => "Building latitude",
                "default_ar" => "خطوط عرض المبنى",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //Customers
        Translation::insert([
            [
                "key" => "customer_create_form",
                "default_en" => "Add new customer",
                "default_ar" => "اضف زبون جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "customer_edit_form",
                "default_en" => "Edit customer form",
                "default_ar" => "نموذج تعديل الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "country",
                "default_en" => "Country name",
                "default_ar" => "اسم الدولة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "city",
                "default_en" => "City name",
                "default_ar" => "اسم المدينة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_name_ar",
                "default_en" => "Customer name (arabic)",
                "default_ar" => "اسم الزبون (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_name_en",
                "default_en" => "Customer name (english)",
                "default_ar" => "اسم الزبون (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_phone",
                "default_en" => "Customer phone",
                "default_ar" => "هاتف الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_email",
                "default_en" => "Customer email",
                "default_ar" => "بريد الزبون الالكتروني",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_nationality",
                "default_en" => "Customer nationality",
                "default_ar" => "جنسية الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_national_id",
                "default_en" => "Customer national id",
                "default_ar" => "الرقم القومي للزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_contact_person",
                "default_en" => "Customer contact person",
                "default_ar" => "معلومات الزبون الشخصية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_contact_phones",
                "default_en" => "Customer contact phones",
                "default_ar" => "هواتف اتصال الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_whatsapp",
                "default_en" => "Customer whatsapp",
                "default_ar" => "رقم واتساب الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_code",
                "default_en" => "Customer code",
                "default_ar" => "كود الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "customer_passport_number",
                "default_en" => "Customer passport number",
                "default_ar" => "رقم جواز سفر الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //reservation
        Translation::insert([
            [
                "key" => "reservation_create_form",
                "default_en" => "Add new reservation",
                "default_ar" => "اضف حجز جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "reservation_edit_form",
                "default_en" => "Edit reservation form",
                "default_ar" => "تعديل نموذج الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "reservation_date",
                "default_en" => "Reservation date",
                "default_ar" => "تاريخ الحجز",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "customer",
                "default_en" => "Customer name",
                "default_ar" => "اسم الزبون",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "sale_man",
                "default_en" => "Sale man name",
                "default_ar" => "اسم رجل المبيعات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "payment_plan",
                "default_en" => "Payment Plan",
                "default_ar" => "خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
        ]);
        //Building wallet
        Translation::insert([
            [
                "key" => "building_wallet_create_form",
                "default_en" => "Add new building wallet",
                "default_ar" => "اضافة محفظة بناء جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "building_wallet_edit_form",
                "default_en" => "Edit building wallet form",
                "default_ar" => "نموذج تعديل محفظة البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "building",
                "default_en" => "Building name",
                "default_ar" => "اسم البناء",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet",
                "default_en" => "Wallet name",
                "default_ar" => "اسم المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "building_wallet_bu_ty",
                "default_en" => "Buty",
                "default_ar" => "الزبد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ]
        ]);
        //Wallet
        Translation::insert([
            [
                "key" => "wallet_create_form",
                "default_en" => "Add new wallet",
                "default_ar" => "اضافة محفظة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet_edit_form",
                "default_en" => "Edit wallet form",
                "default_ar" => "نموذج تعديل محفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "wallet_name_ar",
                "default_en" => "Wallet name (arabic)",
                "default_ar" => "اسم المحفظة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet_name_en",
                "default_en" => "Wallet name (english)",
                "default_ar" => "اسم المحفظة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);
        //Wallet owner
        Translation::insert([
            [
                "key" => "wallet_owner_create_form",
                "default_en" => "Add new wallet owner",
                "default_ar" => "اضافة محفظة مالك جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet_owner_edit_form",
                "default_en" => "Edit wallet owner form",
                "default_ar" => "نموذج تعديل محفظة المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet",
                "default_en" => "Wallet name",
                "default_ar" => "اسم المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "owner",
                "default_en" => "Owner name",
                "default_ar" => "اسم المالك",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "wallet_owner_percentage",
                "default_en" => "Wallet owner percentage",
                "default_ar" => "النسبة المئوية لمالك المحفظة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
        ]);
        //Unit status
        Translation::insert([
            [
                "key" => "unitstatus_create_form",
                "default_en" => "Add new unit status",
                "default_ar" => "اضف حالة وحدة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "unitstatus_edit_form",
                "default_en" => "Edit unit status form",
                "default_ar" => "نموذج تعديل حالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"
            ],
            [
                "key" => "unitstatus_name_ar",
                "default_en" => "Unit status name (arabic)",
                "default_ar" => "اسم حالة الوحدة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "unitstatus_name_en",
                "default_en" => "Unit status name (english)",
                "default_ar" => "اسم حالة الوحدة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "unitstatus_status",
                "default_en" => "Unit status",
                "default_ar" => "حالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
            [
                "key" => "unitstatus_default",
                "default_en" => "Unit status default",
                "default_ar" => "الحالة الافتراضية لحالة الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "real estate"

            ],
        ]);

        //document field
        Translation::insert([
            [
                "key" => "documentFieldName",
                "default_en" => "Document Field Name (arabic)",
                "default_ar" => "اسم حقل المستند (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "documentFieldNameE",
                "default_en" => "Document Field Name (english)",
                "default_ar" => "اسم حقل المستند (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document-field-type",
                "default_en" => "Document Field type",
                "default_ar" => "نوع حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document-field-lookup",
                "default_en" => "Document Field Lookup Table",
                "default_ar" => "بحث  حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document-field-lookup_column",
                "default_en" => "Document Field Lookup Column",
                "default_ar" => "اسم العمود في  حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document-field-reference",
                "default_en" => "Document Field Reference",
                "default_ar" => "مرجع حقل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "documentFieldCreate",
                "default_en" => "Add new Document Field",
                "default_ar" => "اضافة مستند جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "documentFieldEdit",
                "default_en" => "Edit Document Field",
                "default_ar" => "نموذج تعديل المستند",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
        ]);
        //Arch Department Table
        Translation::insert([
            [
                "key" => "ArchiveDepartmentCreate",
                "default_en" => "Add new Archive Department",
                "default_ar" => "اضافة قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "ArchiveDepartmentEdit",
                "default_en" => "Edit Archive Department",
                "default_ar" => "نموذج تعديل قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "archive_department_id",
                "default_en" => "Archive Department",
                "default_ar" => "قسم الأرشيف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "archive_name",
                "default_en" => "name (arabic)",
                "default_ar" => "اسم (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "archive_name_e",
                "default_en" => "name (english)",
                "default_ar" => "اسم (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "archive_status",
                "default_en" => "department status",
                "default_ar" => "حالة القسم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ]
        ]);
        //Document Department Table
        Translation::insert([
            [
                "key" => "document_department_create_form",
                "default_en" => "Add new document department",
                "default_ar" => "إضافة قسم للمستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document_department_edit_form",
                "default_en" => "Edit document department",
                "default_ar" => "تعديل قسم المستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "department",
                "default_en" => "department",
                "default_ar" => "القسم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "document",
                "default_en" => "document",
                "default_ar" => "المستندات",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],

        ]);
        //Arch doc type field Table
        Translation::insert([
            [
                "key" => "arch_doc_type_field_create_form",
                "default_en" => "Add new archiving document type field",
                "default_ar" => "إضافة حقل نوع مستند أرشفة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "arch_doc_type_field_edit_form",
                "default_en" => "Edit archiving document type field",
                "default_ar" => "تعديل حقل نوع مستند أرشفة جديد",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "arch_doc_type",
                "default_en" => "Archiving document type name",
                "default_ar" => "اسم نوع الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "arch_doc_field",
                "default_en" => "Archiving document field name",
                "default_ar" => "اسم حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],

            [
                "key" => "arch_doc_field_order",
                "default_en" => "Archiving document Sort field",
                "default_ar" => "ترتيب حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],

            [
                "key" => "arch_doc_field_character",
                "default_en" => "Archiving document field character",
                "default_ar" => "حرف حقل الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
            [
                "key" => "is_required",
                "default_en" => "Is required",
                "default_ar" => "مطلوب",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "archiving"
            ],
        ]);

        //Payment plan installment
        Translation::insert([
            [
                "key" => "payment_plan_installment_create_form",
                "default_en" => "Add new payment plan installment",
                "default_ar" => "إضافة خطة دفع جديدة بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "payment_plan_installment_edit_form",
                "default_en" => "Edit payment plan installment form",
                "default_ar" => "نموذج تعديل التقسيط لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_plan",
                "default_en" => "installment payment plan name",
                "default_ar" => "اسم خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_plan_detail",
                "default_en" => "Installment payment plan detail",
                "default_ar" => "تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_plan_v_date",
                "default_en" => "Installment payment plan v-date",
                "default_ar" => "التاريخ الخامس لتفاصيل خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],

            [
                "key" => "installment_payment_plan_due_date",
                "default_en" => "Installment payment plan due date",
                "default_ar" => "تاريخ استحقاق خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_plan_total_amount",
                "default_en" => "Installment payment plan total amount",
                "default_ar" => "المبلغ الاجمالي لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_plan_paid_amount",
                "default_en" => "Installment payment plan paid amount",
                "default_ar" => "المبلغ المدفوع لخطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_status",
                "default_en" => "Installment status name",
                "default_ar" => "اسم حالة التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "doc_type",
                "default_en" => "Document type name",
                "default_ar" => "اسم نوع الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "module",
                "default_en" => "Module name",
                "default_ar" => "اسم الوحدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "screen",
                "default_en" => "Screen name",
                "default_ar" => "اسم الشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "ref_id",
                "default_en" => "Ref ID",
                "default_ar" => "رقم الملف",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "rp_code",
                "default_en" => "rp code",
                "default_ar" => "ترميز rp",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
        //Installment Status
        Translation::insert([
            [
                "key" => "installment_status_create_form",
                "default_en" => "Add new Installment Status",
                "default_ar" => "اضافة حاله تقسيط جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_status_edit_form",
                "default_en" => "Edit  Installment Status",
                "default_ar" => "نموذج تعديل حاله التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_status_name",
                "default_en" => "Installment Status name (arabic)",
                "default_ar" => "اسم حاله التقسيط (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_status_name_e",
                "default_en" => "installment_status name (english)",
                "default_ar" => "اسم حاله التقسيط (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_status_default",
                "default_en" => "Installment Status Default",
                "default_ar" => "الحالة الافتراضية لحاله التقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
        //Installment Payment Type
        Translation::insert([
            [
                "key" => "installment_payment_type_create_form",
                "default_en" => "Add new Installment Payment Type",
                "default_ar" => "اضافة نوع دفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_edit_form",
                "default_en" => "Edit  Installment Payment Type",
                "default_ar" => "نموذج تعديل نوع الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_name",
                "default_en" => "Installment Payment Type name (arabic)",
                "default_ar" => "اسم نوع دفع بالتقسيط (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_name_e",
                "default_en" => "Installment Payment Type name (english)",
                "default_ar" => "اسم نوع دفع بالتقسيط (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_auto_freq",
                "default_en" => "Installment Status Auto Freq",
                "default_ar" => "حالة تقسيط التكرار التلقائي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_is_partially",
                "default_en" => "Installment Payment Partially",
                "default_ar" => "تقسيط السداد جزئيا",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ]
        ]);
        //Main Contact Groups
        Translation::insert([
            [
                "key" => "MainContactGroupsCreate",
                "default_en" => "Add new Main Contact Group",
                "default_ar" => "اضافة مجموعة الاتصال الرئيسية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "MainContactGroupsEdit",
                "default_en" => "Edit Main Contact Group",
                "default_ar" => "نموذج تعديل مجموعة الاتصال الرئيسية",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "Group_name",
                "default_en" => "name Group (arabic)",
                "default_ar" => "اسم المجموعة (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "Group_name_e",
                "default_en" => "name Group (english)",
                "default_ar" => "اسم المجموعة (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
        //Installment Payment Plan Detail
        Translation::insert([
            [
                "key" => "InstallmentPaymentPlanDetailCreate",
                "default_en" => "Add new Installment Payment Plan Detail",
                "default_ar" => "اضافة تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "InstallmentPaymentPlanDetailEdit",
                "default_en" => "Edit Installment Payment Plan Detail",
                "default_ar" => "نموذج تعديل تفاصيل خطة الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_id",
                "default_en" => "installment payment type",
                "default_ar" => "نوع الدفع بالتقسيط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "ln_no",
                "default_en" => "Line No",
                "default_ar" => "رقم الخط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "is_fixed",
                "default_en" => "is fixed",
                "default_ar" => "تم إصلاحه",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_per",
                "default_en" => "installment payment type per",
                "default_ar" => "لكل",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_amount",
                "default_en" => "installment payment type amount",
                "default_ar" => "المبلغ",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type_freq",
                "default_en" => "installment payment type freq",
                "default_ar" => "عدد الاقساط",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "interest_per",
                "default_en" => "interest per",
                "default_ar" => "نسبة الفايدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "interest_value",
                "default_en" => "interest value",
                "default_ar" => "قيمة الفايدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
        //Role user
        Translation::insert([
            [
                "key" => "role_user_create_form",
                "default_en" => "Add new role user",
                "default_ar" => "اضف دور للمستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role user"
            ],
            [
                "key" => "role_user_edit_form",
                "default_en" => "Edit role user",
                "default_ar" => "تعديل دور المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role user"
            ],
            [
                "key" => "role",
                "default_en" => "Role name",
                "default_ar" => "اسم الدور",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role user"
            ],
            [
                "key" => "user",
                "default_en" => "User name",
                "default_ar" => "اسم المستخدم",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "role user"
            ],
        ]);
        //Installment payment plan
        Translation::insert([
            [
                "key" => "installment_payment_plan_create",
                "default_en" => "Add new install payment plan",
                "default_ar" => "اضف خطة دفع جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_edit_form",
                "default_en" => "Edit install payment plan",
                "default_ar" => "تعديل خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_name_ar",
                "default_en" => "Installment payment name (arabic)",
                "default_ar" => "اسم خطة الدفع (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_name_en",
                "default_en" => "Install payment plan name (english)",
                "default_ar" => "اسم خطة الدفع (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "is_default",
                "default_en" => "Is default",
                "default_ar" => "افتراضي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "is_active",
                "default_en" => "Is active",
                "default_ar" => "فعال",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_description_ar",
                "default_en" => "Installment payment description (arabic)",
                "default_ar" => "وصف خطة الدفع (عربي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_description_en",
                "default_en" => "Install payment plan description (english)",
                "default_ar" => "وصف خطة الدفع (انجليزي)",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_start_date",
                "default_en" => "Install payment plan start date",
                "default_ar" => "تاريخ بداية خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_payment_type",
                "default_en" => "Install payment type name",
                "default_ar" => "اسم نوع الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
         //installment document plan
         Translation::insert([
            [
                "key" => "installment_document_plan_create_form",
                "default_en" => "Add document plan",
                "default_ar" => "اضف خطة وثيقة جديدة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_document_plan_edit_form",
                "default_en" => "Edit installment document plan",
                "default_ar" => "تعديل خطة وثيقة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "installment_plan",
                "default_en" => "Installment plan",
                "default_ar" => "خطة الدفع",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
          //screen sub contact group
          Translation::insert([
            [
                "key" => "screen_subcontact_group_create_form",
                "default_en" => "Add new screen subcontact group",
                "default_ar" => "اضف جروب اتصال فرعي للشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "screen_subcontact_group_edit_form",
                "default_en" => "Edit screen subcontact group",
                "default_ar" => "تعديل جروب الاتصال الفرعي للشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "subcontact_group",
                "default_en" => "Subcontact group name",
                "default_ar" => "اسم جروب التواصل الفرعي",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
            [
                "key" => "screen",
                "default_en" => "Screen name",
                "default_ar" => "اسم الشاشة",
                "new_ar" => "",
                "new_en" => "",
                "company_id" => 0,
                "screen" => "receivable payable"
            ],
        ]);
    }
    
}
