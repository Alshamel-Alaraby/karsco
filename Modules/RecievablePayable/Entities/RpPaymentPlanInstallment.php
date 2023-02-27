<?php

namespace Modules\RecievablePayable\Entities;

use App\Models\Document;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpPaymentPlanInstallment extends Model
{
    use HasFactory, LogTrait;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\RecievablePayable\Database\factories\RpPaymentPlanInstallmentFactory::new();
    }

    public function document()
    {
        return $this->belongsTo(\App\Models\Document::class,'doc_type_id','id');
    }

    public function installment_payment_plan()
    {
        return $this->belongsTo(RpInstallmentPaymentPlan::class, "installment_payment_plan_id");
    }

    public function installment_payment_type()
    {
        return $this->belongsTo(RpInstallmentPaymentType::class, "installment_payment_type_id");
    }
    public function installment_status()
    {
        return $this->belongsTo(RpInstallmentStatus::class, "installment_status_id");
    }
}
