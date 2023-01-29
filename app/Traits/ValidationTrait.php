<?php

namespace App\Traits;

trait ValidationTrait
{

    public function messages()
    {
        return [
            'required' => __('message.field is required'),
            'unique' => __('message.field must be exists'),
            'email' => __('message.field must be email'),
            'string' => __('message.field must be string'),
            'max' => __('message.field must be less than 255 character'),
            'integer' => __('message.field must be integer'),
            'exists' => __('message.field must be exists'),
            'mimes' => __('message.field must be media'),
            'in' => __('message.field must be in active,inactive'),
            'unique' => __('message.field must be unique'),
            'max' => __('message.field must be less than 100 character'),
            'max' => __('message.field must be less than 10 character'),
            'exists' => __('message.field must be exists'),
            
        ];
    }

}
