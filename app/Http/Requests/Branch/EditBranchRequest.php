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
            'name' => ["required", new BranchUniqueCompanyRule($this->company_id, $this->id)],
            'name_e' => ["required", new BranchUniqueCompanyRule($this->company_id, $this->id)],
            "company_id" => "required|exists:companies,id",
        ];
    }

}
