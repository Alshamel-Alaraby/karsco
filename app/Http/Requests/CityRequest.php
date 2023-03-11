<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
                "name" => "sometimes|unique:general_cities,name,". $this->city,
                "name_e" => "sometimes|unique:general_cities,name_e,". $this->city,
                "country_id" => "nullable|exists:general_countries,id",
                "governorate_id" => "nullable|exists:general_governorates,id",
                "company_id" => "nullable",
                "is_active"=>"nullable"
            ];
        }else{
            return [
                "name" => "sometimes|unique:general_cities,name",
                "name_e" => "sometimes|unique:general_cities,name_e",
                "country_id" => "nullable|exists:general_countries,id",
                "governorate_id" => "nullable|exists:general_governorates,id",
                "company_id" => "nullable",
                "is_active"=>"nullable"
            ];
        }



    }
}
