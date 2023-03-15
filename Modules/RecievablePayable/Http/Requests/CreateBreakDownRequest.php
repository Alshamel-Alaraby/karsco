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
            'break_downs' => 'required|array',
            'break_downs.*.instalment_date' => 'required|date',
            'break_downs.*.rate' => 'required|regex:/^\d+(\.\d{2,2})?$/',
            'break_downs.*.currency_id' => 'required|integer',
            'break_downs.*.customer_id' => 'required|integer',
            'break_downs.*.opening_balance_id' => 'required|integer',
            'break_downs.*.instalment_type_id' => 'required|integer',
            'break_downs.*.document_id' => 'nullable|integer',
            'break_downs.*.debit' => 'nullable|regex:/^\d+(\.\d{5,5})?$/',
            'break_downs.*.credit' => 'nullable|regex:/^\d+(\.\d{5,5})?$/',
            'break_downs.*.repate' => 'required|integer',
            'break_downs.*.total' => 'required|regex:/^\d+(\.\d{2,2})?$/',
            "break_downs.*.terms"  => "nullable|array",
            'break_downs.*.installment_statu_id' => 'nullable|integer',
            'break_downs.*.details' => 'nullable|string',
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
