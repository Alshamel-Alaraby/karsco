<?php

namespace Modules\GL\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditGlCoaRequest extends FormRequest
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
            'acc_no' => 'required',
            'name' => 'required|unique:gl_coas,name,'.$this->id,
            'name_e' => 'required|unique:gl_coas,name_e,'.$this->id,
            'parent_no' => 'required',
            'accounttype_id' => 'required',
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
