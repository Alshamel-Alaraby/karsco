<?php

namespace Modules\RecievablePayable\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BreakDownResource extends JsonResource
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
            "rate"=>$this->rate,
            "currency_id"=>$this->currency_id,
            "customer_id"=>$this->customer_id,
            "opening_balance_id"=>$this->opening_balance_id,
            "document_id"=>$this->document_id,
            "debit"=>$this->debit,
            "credit"=>$this->credit,
            "instalment_type_id"=>$this->instalment_type_id,
            "terms"=>$this->terms,
            "repate"=>$this->repate,
            "instalment_date"=>$this->instalment_date,
            "total"=>$this->total,
            "details"=>$this->details,
            "installment_statu_id"=>$this->installment_statu_id,
            "document"=>$this->document,
            "currency"=>$this->currency,
            "customer"=>$this->customer,
            "installment_status"=>$this->installment_status,
            "installment_payment_type"=>$this->installment_payment_type,
            "opening_balance"=>$this->opening_balance,




        ];

    }
}
