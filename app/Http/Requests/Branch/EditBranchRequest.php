<?php

namespace App\Http\Requests\Branch;

use App\Rules\BranchUniqueCompanyRule;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditBranchRequest extends FormRequest
{
    use ValidationTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ["nullable"],
            'name_e' => ["nullable"],
            'is_active' => ["nullable"],
            "company_id" => "nullable",
        ];
    }

}
