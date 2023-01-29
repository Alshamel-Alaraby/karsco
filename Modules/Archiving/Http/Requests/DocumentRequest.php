<?php

namespace Modules\Archiving\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'arch_doc_type' => ['required', 'integer'],
            'doc_description' => ['required', 'string', 'max:500'],
            'doc_status' => ['required', 'integer'],
            'url_reference' => ['required', "url", "string", "max:200"],
        ];
    }
    public function messages()
    {
        return [
            'gen_arch_doc_type.required' => __("message.field is required"),
            'gen_arch_doc_type.integer' => __("message.field must be integer"),
            'doc_description.required' => __("message.field is required"),
            'doc_description.string' => __("message.field must be string"),
            'doc_description.max' => __("message.field must be less than 500 characters"),
            'doc_status.required' => __("message.field is required"),
            'doc_status.integer' => __("message.field must be integer"),
            'url_reference.required' => __("message.field is required"),
            'url_reference.url' => __("message.field must be url"),
            'url_reference.string' => __("message.field must be string"),
            'url_reference.max' => __("message.field must be less than 200 characters"),
        ];

    }

}
