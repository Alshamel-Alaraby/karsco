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
            'name' => ["required"],
            'name_e' => ["required"],
            "company_id" => "required",
        ];
    }

}
