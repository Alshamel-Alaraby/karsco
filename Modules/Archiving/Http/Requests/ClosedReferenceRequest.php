<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClosedReferenceRequest extends FormRequest
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
            'docfields_id' => ['required', 'integer', 'exists:arch_document_fields,id'],
            'field_value' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'docfields_id.required' => __("message.field is required"),
            'docfields_id.integer' => __("message.field must be integer"),
            'docfields_id.exists' => __("message.field not found"),
            'field_value.required' => __("message.field is required"),

        ];
    }

}
