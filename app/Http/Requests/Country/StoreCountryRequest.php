<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'name_e' => 'nullable|string|max:255',
            "is_default" => "nullable|in:0,1",
            "phone_key" => "nullable",
            'national_id_length' => "nullable|integer",
            'long_name' => "nullable|max:100",
            'long_name_e' => "nullable|max:100",
            'short_code' => "nullable|max:10",
            'is_active' => 'nullable|in:active,inactive',
            // "media" => "nullable|array",
            // "media.*" => ["nullable", "exists:media,id", new \App\Rules\MediaRule()],


        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages()
    {
        return [
            'name.required' => __('message.field is required'),
            'name.string' => __('message.field must be string'),
            'name.max' => __('message.field must be less than 255 character'),
            'name.unique' => __('message.field must be unique'),
            'name_e.required' => __('message.field is required'),
            'name_e.string' => __('message.field must be string'),
            'name_e.max' => __('message.field must be less than 255 character'),
            'name_e.unique' => __('message.field must be unique'),
            'is_default.required' => __('message.field is required'),
            'is_default.in' => __('message.field must be in 0,1'),
            'phone_key.required' => __('message.field is required'),
            'phone_key.unique' => __('message.field must be unique'),
            'national_id_length.required' => __('message.field is required'),
            'national_id_length.integer' => __('message.field must be integer'),
            'long_name.required' => __('message.field is required'),
            'long_name.max' => __('message.field must be less than 100 character'),
            'long_name_e.required' => __('message.field is required'),
            'long_name_e.max' => __('message.field must be less than 100 character'),
            'short_code.required' => __('message.field is required'),
            'short_code.max' => __('message.field must be less than 10 character'),
            'is_active.in' => __('message.field must be in active,inactive'),
            'media.array' => __('message.field must be array'),
            'media.*.exists' => __('message.field must be exists in media table'),
            'media.*.media' => __('message.field must be media'),

        ];
    }
}
