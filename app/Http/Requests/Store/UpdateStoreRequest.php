<?php

namespace App\Http\Requests\Store;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name' => 'string|max:255',
            'name_e' => 'string|max:255',
            'company_id' => 'integer',
            'branch_id' => 'integer|exists:branches,id',
            'is_active' => 'nullable|in:active,inactive',

        ];
    }

}
