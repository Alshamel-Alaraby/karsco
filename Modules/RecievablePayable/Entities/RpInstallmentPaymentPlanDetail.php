<?php

namespace Modules\RecievablePayable\Entities;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpInstallmentPaymentPlanDetail extends Model
{
    use HasFactory,LogTrait;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\RecievablePayable\Database\factories\RpInstallmentPaymentPlanDetailFactory::new();
    }
    public function installment_payment_plan()
    {
        return $this->belongsTo(RpInstallmentPaymentPlan::class, "installment_payment_plan_id");
    }

    public function installment_payment_Type()
    {
        return $this->belongsTo(RpInstallmentPaymentType::class, "installment_payment_type_id");
    }


    public function hasChildren()
    {
        return $this->installment_payment_Type()->count() > 0 ;
    }
}
