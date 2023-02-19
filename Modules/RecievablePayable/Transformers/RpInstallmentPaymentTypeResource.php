<?php

namespace Modules\RecievablePayable\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RpInstallmentPaymentTypeResource extends JsonResource
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
            "id"=>$this->id,
            "name"=>$this->name,
            "name_e"=>$this->name_e,
            "auto_freq"=>$this->auto_freq,
            "is_partially"=>$this->is_partially,
            "is_passed"=>$this->is_passed,
            "is_passed_all"=>$this->is_passed_all,
            "freq_period"=>$this->freq_period,
            "day_month"=>$this->day_month,
            "is_conditional"=>$this->is_conditional,
            "installment_condation_id"=>$this->installment_condation_id,
            "installment_condation"=>$this->installment_condation,
        ];
    }
}
