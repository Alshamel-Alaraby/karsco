<?php

namespace App\Models;

use App\Traits\BulkDeleteTrait;
use App\Traits\CanDeleteTrait;
use App\Traits\CompanyScopeTrait;
use App\Traits\ConnTrait;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralCustomer extends Model
{
    use HasFactory,LogTrait, CompanyScopeTrait;
    protected $table = 'general_customers';

    protected $guarded = ['id'];
}
