<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocTypeFieldRequest extends FormRequest
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
            'doc_type_id' => ['required'],
            'doc_field_id' => ['required'],
            // 'field_characters' => ['nullable', 'string'],
            'field_order' => ['required', 'integer'],
            'is_required' => ['required', Rule::in(['1', '0'])],
        ];
    }

    public function messages()
    {
        return [
            'gen_doc_type_id.required' => __("message.field is required"),
            'doc_field_id.required' => __("message.field is required"),
            'field_characters.required' => __("message.field is required"),
            'field_characters.integer' => __("message.field must be integer"),
            'field_order.required' => __("message.field is required"),
            'field_order.integer' => __("message.field must be integer"),
            'is_required.required' => __("message.field is required"),
            'is_required.in' => __("message.field must be 1 or 0"),
        ];

    }
}
