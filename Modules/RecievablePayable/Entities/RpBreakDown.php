<?php

namespace Modules\RecievablePayable\Entities;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpBreakDown extends Model
{
    use HasFactory,LogTrait;

    protected $guarded = ['id'];
    public function document()
    {
        return $this->belongsTo(\App\Models\Document::class,'document_id',);
    }

    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class,'currency_id',);
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\GeneralCustomer::class,'customer_id',);
    }

    public function installment_status()
    {
        return $this->belongsTo(RpInstallmentStatus::class,'installment_statu_id',);
    }

    public function installment_payment_type()
    {
        return $this->belongsTo(RpInstallmentPaymentType::class,'instalment_type_id',);
    }
    public function opening_balance()
    {
        return $this->belongsTo(RpOpeningBalance::class,'opening_balance_id',);
    }




    protected static function newFactory()
    {
        return \Modules\RecievablePayable\Database\factories\RpBreakDownFactory::new();
    }
}
