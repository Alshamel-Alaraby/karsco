<?php

namespace App\Http\Requests\Branch;

use App\Rules\BranchUniqueCompanyRule;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBranchRequest extends FormRequest
{

    use ValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ["required"],
            'name_e' => ["required"],
            'is_active' => ["required"],
            "company_id" => "required",
        ];
    }

}
