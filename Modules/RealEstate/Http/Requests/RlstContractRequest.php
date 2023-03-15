<?php

namespace Modules\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RlstContractRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "date" => "required|date",
            "salesman_id" => [
                "required",
                // "exists:tree_properties,id,deleted_at,null"
            ],
            "reservation_id" => [
                "required",
                // "exists:tree_properties,id,deleted_at,null"
            ],
            "customer_id" => [
                "required",
                // "exists:tree_properties,id,deleted_at,null"
            ],
            // "payment_plan_id" => "required|numeric",
        ];
    }


}
