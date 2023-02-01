<?php


namespace App\Traits;


use App\Scopes\HasCompanyScope;

trait CompanyScopeTrait
{

    protected static function booted()
    {
        static::addGlobalScope(new HasCompanyScope());
    }

}
