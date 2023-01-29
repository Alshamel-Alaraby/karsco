<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentDtlRequest extends FormRequest
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
            'arch_doc_type_id' => ['required'],
            'arch_doc_field_id' => ['required'],
            'field_value' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'gen_arch_doc_type_id.required' => __("message.field is required"),
            'arch_doc_field_id.required' => __("message.field is required"),
            'field_value.required' => __("message.field is required"),
        ];

    }

}
