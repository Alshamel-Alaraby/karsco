<?php

namespace Modules\RecievablePayable\Entities;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpInstallmentPaymentPlan extends Model
{
    use HasFactory, LogTrait;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\RecievablePayable\Database\factories\RpInstallmentPaymentPlanFactory::new();
    }
    public function payment_plan_installments()
    {
        return $this->hasMany(RpPaymentPlanInstallment::class, "installment_payment_plan_id");
    }

}
