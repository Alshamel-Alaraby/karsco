<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
//        dd($this->id);
        if ($this->method() == 'PUT'){
            return [
                'name' => 'nullable|string|max:255|unique:general_colors,name,'.$this->id,
                'name_e' => 'nullable|string|max:255|unique:general_colors,name_e,'.$this->id,
                "is_active" => "nullable|in:active,inactive",
            ];
        }else{
            return [
                'name' => 'nullable|string|max:255|unique:general_colors,name',
                'name_e' => 'nullable|string|max:255|unique:general_colors,name_e',
                "is_active" => "nullable|in:active,inactive",
            ];
        }

    }

}
