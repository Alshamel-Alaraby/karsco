<?php

namespace App\Http\Requests\Governorate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGovernorateRequest extends FormRequest
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
            "name" => ["nullable", Rule::unique('general_governorates')->where(function ($querry) {
                $querry
                    ->where("country_id", request()->country_id)
                    ->where("name", request()->name);
            })->ignore($this->id)],
            "name_e" => ["nullable", Rule::unique('general_governorates')->where(function ($querry) {
                $querry
                    ->where("country_id", request()->country_id)
                    ->where("name_e", request()->name_e);
            })->ignore($this->id)],
            "is_active" => "nullable|in:active,inactive",
            "is_default" => "nullable|in:0,1",
            "country_id" => "nullable|exists:general_countries,id",
            'phone_key' => "nullable|max:10",
        ];
    }

    public function messages()
    {
        return [
            'name.string' => __('message.field must be string'),
            'name.max' => __('message.field must be less than 255 character'),
            'name_e.string' => __('message.field must be string'),
            'name_e.max' => __('message.field must be less than 255 character'),
            'country_id.exists' => __('message.field must be exists'),
            'is_default.in' => __('message.field must be in 0,1'),
            'phone_key.unique' => __('message.field must be unique'),
            'is_active.in' => __('message.field must be in active,inactive'),
        ];
    }
}
