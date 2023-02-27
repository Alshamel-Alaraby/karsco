<?php

namespace App\Http\Requests\City;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditCityRequest extends FormRequest
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
            "name" => "nullable|unique:general_cities,name," . $this->city,
            "name_e" => "nullable|unique:general_cities,name_e," . $this->city,
            "country_id" => "nullable|exists:general_countries,id",
            "governorate_id" => "nullable|exists:general_governorates,id",
        ];
    }

}
