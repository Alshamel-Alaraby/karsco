<?php

namespace Modules\RecievablePayable\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateRpInstallmentPaymentTypeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:rp_installment_payment_types,name',
            'name_e' => 'required|string|max:255|unique:rp_installment_payment_types,name_e',
            'is_conditional' => [],
            'installment_condation_id' => ['required_if:is_conditional,==,1'],
            "installment_payment_type_per" => [],
            "installment_payment_type_freq" => 'nullable|numeric|min:1',
            "interest_per" => [],
            'is_partially' => [],
            'is_passed' => [],
            'is_passed_all' => [],
            'is_passed_contract_plan' => [],
            'auto_freq' => ['required_if:installment_payment_type_freq.*,>=,1' ],
            'freq_period' => [],
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
