<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocTypeDepartmentRequest extends FormRequest
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
            'arch_doc_type_id' => 'required|integer|exists:arch_doc_types,id',
            'arch_department_id' => 'required|integer|exists:arch_departments,id',
        ];
    }

    public function messages()
    {
        return [
            "arch_doc_type_id.required" => __("message.field is required"),
            "arch_doc_type_id.integer" => __("message.field must be integer"),
            "arch_doc_type_id.exists" => __("message.field must be exists"),
            "arch_department_id.required" => __("message.field is required"),
            "arch_department_id.integer" => __("message.field must be integer"),
            "arch_department_id.exists" => __("message.field must be exists"),
        ];
    }

}
