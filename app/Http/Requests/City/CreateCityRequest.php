<?php

namespace App\Http\Requests\City;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCityRequest extends FormRequest
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
            "name" => "required|unique:cities,name",
            "name_e" => "required|unique:cities,name_e",
            "country_id" => "required|exists:countries,id",
            "governorate_id" => "required|exists:governorates,id",
        ];
    }

}
