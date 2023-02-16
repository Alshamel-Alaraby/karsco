<?php

namespace App\Http\Requests\GeneralCustomer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateGeneralCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required'],
            'name_e'=>['required'],
            'phone'=>['required'],
            'email'=>['required'],
            'country_id'=>['numeric'],
            'city_id'=>['numeric'],
            'rp_code'=>[],
            'nationality'=>[],
            'bank_account_id'=>['numeric'],
            'contact_phone'=>[],
            'national_id'=>[],
            'whatsapp'=>[],
            'passport_no'=>[],
            'note1'=>[],
            'note2'=>[],
            'note3'=>[],
            'note4'=>[],
            'city_id'=>['numeric'],

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

    /*
    * custom failedValidation response
    */
    public function failedValidation ( Validator $validator )
    {
        throw new HttpResponseException(response()->json(
            [
                'status'    => 422,

                'success'   => false,

                'message'   => __ ('validation errors'),

                'data'      => $validator->errors()
            ],
            422
        ));
    }

    /*
     * translate failedValidation messages
     */
    public function messages ()
    {
        return [
            'required'=>__ ('required'),
            'unique'=>__ ('exists')
        ];
    }
}
