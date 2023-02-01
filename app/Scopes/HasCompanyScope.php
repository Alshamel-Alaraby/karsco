<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HasCompanyScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply ( Builder $builder , Model $model )
    {
        $builder->where('company_id', request ()->header ('company-id'));
    }
}
