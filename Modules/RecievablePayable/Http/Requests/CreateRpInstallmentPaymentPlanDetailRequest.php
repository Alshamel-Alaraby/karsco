<?php

namespace Modules\RecievablePayable\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateRpInstallmentPaymentPlanDetailRequest extends FormRequest
{
    use ValidationTrait;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "installment_payment_plan_details"    => "required|array",
            "installment_payment_plan_details.*.installment_payment_plan_id" => "required",
            "installment_payment_plan_details.*.installment_payment_type_id" => "required",
            "installment_payment_plan_details.*.ln_no" => "required",
            "installment_payment_plan_details.*.is_fixed" => [],
            "installment_payment_plan_details.*.installment_payment_type_per" => [],
            "installment_payment_plan_details.*.installment_payment_type_freq" => [],
            "installment_payment_plan_details.*.interest_per" => [],

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

}
