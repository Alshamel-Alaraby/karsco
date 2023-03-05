<?php

namespace Modules\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RlstUnitEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => "nullable|string|max:20",
            'name' => "nullable|string|max:100",
            'name_e' => "nullable|string|max:100",
            'description' => "nullable|string",
            'description_e' => "nullable|string",
            'unit_ty' => "nullable|integer",
            'unit_status_id' => "nullable|integer|exists:rlst_unit_statuses,id",
            'unit_area' => "nullable|numeric",
            'unit_net_area' => "nullable|numeric",
            'building_id' => "nullable|integer|exists:rlst_buildings,id",
            'rooms' => "nullable|integer",
            'path' => "nullable|integer",
            'view' => "nullable|integer",
            'floor' => "nullable|integer",
            'finishing' => "nullable|integer",
            'properties' => "nullable|array",
            'attachments' => "nullable|array",
            'module' => "nullable|string",
            "media" => "nullable|array",
            "media.*" => ["nullable", "exists:media,id", new \App\Rules\MediaRule()],
            'old_media.*' => ['nullable', "exists:media,id", new \App\Rules\MediaRule("Modules\RealEstate\Entities\RlstUnit")],
            ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'bank_id.required' => __('message.field is required'),
            'bank_id.exists' => __('message.field must be exists in banks table'),
            'account_number.required' => __('message.field is required'),
            'account_number.string' => __('message.field must be string'),
            'account_number.max' => __('message.field must be less than 255 character'),
            'phone.required' => __('message.field is required'),
            'phone.string' => __('message.field must be string'),
            'phone.max' => __('message.field must be less than 255 character'),
            'address.required' => __('message.field is required'),
            'address.string' => __('message.field must be string'),
            'address.max' => __('message.field must be less than 255 character'),
            'email.required' => __('message.field is required'),
            'email.string' => __('message.field must be string'),
            'email.max' => __('message.field must be less than 255 character'),
            'emp_id.required' => __('message.field is required'),

            'emp_id.string' => __('message.field must be string'),
            'emp_id.max' => __('message.field must be less than 255 character'),
            'rp_code.required' => __('message.field is required'),
            'rp_code.string' => __('message.field must be string'),
            'rp_code.max' => __('message.field must be less than 255 character'),

            'media.exists' => __('message.field must be exists'),
            'media.media' => __('message.field must be media'),

        ];
    }
}
