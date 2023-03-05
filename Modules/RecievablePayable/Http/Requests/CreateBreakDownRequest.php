<?php

namespace Modules\RecievablePayable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBreakDownRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'instalment_date' => 'required|date',
            'rate' => 'required|regex:/^\d+(\.\d{2,2})?$/',
            'currency_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'opening_balance_id' => 'required|integer',
            'instalment_type_id' => 'required|integer',
            'document_id' => 'required|integer',
            'debit' => 'nullable|regex:/^\d+(\.\d{5,5})?$/',
            'credit' => 'nullable|regex:/^\d+(\.\d{5,5})?$/',
            'repate' => 'required|integer',
            'total' => 'required|regex:/^\d+(\.\d{2,2})?$/',
            "terms"  => "nullable|array",
            'installment_statu_id' => 'nullable|integer',
            'details' => 'nullable|string',
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
