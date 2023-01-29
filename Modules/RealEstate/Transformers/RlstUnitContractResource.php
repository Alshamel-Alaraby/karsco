<?php

namespace Modules\RealEstate\Transformers;

use App\Http\Resources\Salesman\SalesmanResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RlstUnitContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "property" => new \App\Http\Resources\TreeProperty\TreePropertyResource($this->property),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
