<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
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

        return [
            'name' => 'nullable|unique:general_currencies,name',
            'name_e' => 'nullable|unique:general_currencies,name_e',
            'symbol' => 'nullable|unique:general_currencies,symbol',
            'symbol_e' => 'nullable|unique:general_currencies,symbol_e',
            'code' => 'nullable|unique:general_currencies,code',
            'code_e' => 'nullable|unique:general_currencies,code_e',
            'is_active' => 'nullable|in:0,1',
            "is_default" => "nullable|in:0,1",
            'fraction' => [],
            'fraction_e' => [],
            'fraction_no' => [],
            "company_id"=>"required"
        ];
    }

}
