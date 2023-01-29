<?php

namespace Modules\RecievablePayable\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditRpInstallmentPaymentPlanRequest extends FormRequest
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
            'name' => 'required|unique:rp_installment_payment_plans,name,'.$this->id,
            'name_e' => 'required|unique:rp_installment_payment_plans,name_e,'.$this->id,
            'is_default' => 'required',
            'is_active' => [],
            'description' => [],
            'description_e' => [],
            'start_date' => [],
            'installment_payment_type_id' => [],
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
