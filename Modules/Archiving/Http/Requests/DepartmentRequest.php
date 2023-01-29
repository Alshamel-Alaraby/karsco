<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        // if update action with method put will be unique expect id
        if ($this->method() == 'PUT') {
            return [
                "name" => ["required", "string", "max:100", "unique:arch_departments,name," . $this->id],
                "name_e" => ["required", "string", "max:100"],
                "parent_id" => ['nullable', 'integer'],
                "is_active" => "nullable|in:active,inactive",
            ];
        }
        return [
            "name" => ["required", "string", "max:100", "unique:arch_departments,name"],
            "name_e" => ["required", "string", "max:100", "unique:arch_departments,name_e"],
            "parent_id" => ['nullable', 'integer'],
            "is_active" => "nullable|in:active,inactive",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => __("message.field is required"),
            "name.string" => __("message.field must be string"),
            "name.max" => __("message.field must be less than 100 characters"),
            "name.unique" => __("message.field must be unique"),
            "name_e.required" => __("message.field is required"),
            "name_e.string" => __("message.field must be string"),
            "name_e.max" => __("message.field must be less than 100 characters"),
            "name_e.unique" => __("message.field must be unique"),
            "parent_id.integer" => __("message.field must be integer"),
            "is_active.in" => __("message.field must be active or inactive"),
        ];
    }

}
