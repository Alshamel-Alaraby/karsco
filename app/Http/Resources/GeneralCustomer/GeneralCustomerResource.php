<?php

namespace App\Http\Resources\GeneralCustomer;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'=>$this->id,
            'name'=>$this->name,
            'name_e'=>$this->name_e,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'country_id'=>$this->country_id,
            'city_id'=>$this->city_id,
            'rp_code'=>$this->rp_code,
            'nationality'=>$this->nationality,
            'bank_account_id'=>$this->bank_account_id,
            'contact_person'=>$this->contact_person,
            'contact_phone'=>$this->contact_phone,
            'national_id'=>$this->national_id,
            'whatsapp'=>$this->whatsapp,
            'passport_no'=>$this->passport_no,
            'note1'=>$this->note1,
            'note2'=>$this->note2,
            'note3'=>$this->note3,
            'note4'=>$this->note4,

        ];
    }
}
