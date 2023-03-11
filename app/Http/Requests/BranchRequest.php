<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
{

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
        if ($this->method() == 'PUT'){
            return [
                "name" => "sometimes|unique:general_branches,name,". $this->branch,
                "name_e" => "sometimes|unique:general_branches,name_e,". $this->branch,
                "country_id" => "nullable|exists:general_countries,id",
                "is_active"=>"nullable"
            ];
        }else{
            return [
                "name" => "sometimes|unique:general_branches,name",
                "name_e" => "sometimes|unique:general_branches,name_e",
                "company_id" => "nullable",
                "is_active"=>"nullable"
            ];
        }
    }

}
