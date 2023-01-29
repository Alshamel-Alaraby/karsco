<?php

namespace App\Models;

use App\Traits\BulkDeleteTrait;
use App\Traits\CanDeleteTrait;
use App\Traits\ConnTrait;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralCustomer extends Model
{
    use HasFactory,LogTrait,ConnTrait;

    protected $guarded = ['id'];
}
