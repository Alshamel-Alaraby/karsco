<?php

namespace App\Http\Requests\Bank;

use App\Rules\BankUniqueNameCountryRule;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreBankRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'max:255', 'string', new BankUniqueNameCountryRule($this->country_id)],
            'name_e' => ['nullable', 'max:255', 'string', new BankUniqueNameCountryRule($this->country_id)],
            "country_id" => "nullable|exists:general_countries,id",
            "swift_code" => "nullable|string",
        ];
    }

}
