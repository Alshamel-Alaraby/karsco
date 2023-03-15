<?php

namespace Modules\RecievablePayable\Entities;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpOpeningBalance extends Model
{
    use HasFactory,LogTrait;

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(\App\Models\GeneralCustomer::class,'customer_id','id');
    }


    protected static function newFactory()
    {
        return \Modules\RecievablePayable\Database\factories\RpOpeningBalanceFactory::new();
    }
}
