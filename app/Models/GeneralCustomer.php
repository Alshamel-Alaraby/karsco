<?php

namespace App\Models;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\RecievablePayable\Entities\RpOpeningBalance;

class GeneralCustomer extends Model
{
    use HasFactory, LogTrait;
    protected $table = 'general_customers';

    protected $guarded = ['id'];

    public function opening_balances()
    {
        return $this->hasMany(RpOpeningBalance::class,'customer_id');
    }



}
