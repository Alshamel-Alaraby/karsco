<?php

namespace Modules\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RlstReservationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "date" => "required|date",
            "salesman_id" => "required|exists:general_salesmen,id",
            "customer_id" => "required|exists:rlst_customers,id",
            "payment_plan_id" => "required|numeric",
        ];
    }


}
