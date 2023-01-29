<?php

namespace App\Http\Requests\PaymentType;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentTypeRequest extends FormRequest
{
    use ValidationTrait;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:payment_types,name,' . $this->id,
            'name_e' => 'required|string|max:255|unique:payment_types,name_e,' . $this->id,
            'is_default' => 'nullable|in:1,0',
        ];
    }

}
