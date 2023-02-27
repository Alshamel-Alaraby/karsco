<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
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
            'name' => 'nullable|string|max:255|unique:general_colors,name,' . $this->id,
            'name_e' => 'nullable|string|max:255|unique:general_colors,name_e,' . $this->id,
            "is_active" => "nullable|in:active,inactive",
        ];
    }

}
