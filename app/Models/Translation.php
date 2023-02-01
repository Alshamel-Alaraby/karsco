<?php

namespace App\Models;

use App\Traits\CompanyScopeTrait;
use App\Traits\ConnTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $table="general_translations";
    protected $guarded = ['id'];
}
