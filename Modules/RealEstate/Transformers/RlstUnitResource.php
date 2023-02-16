<?php

namespace Modules\RealEstate\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RlstUnitResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'name_e' => $this->name_e,
            'description' => $this->description,
            'description_e' => $this->description_e,
            'unit_ty' => $this->unit_ty,
            'status_date' => $this->status_date,
            'unit_area' => $this->unit_area,
            // 'building_id' => $this->building_id,
            "building" => new RlstBuildingResource($this->building),
            // 'owner_id' => $this->owner_id,
            "owner" => new RlstOwnerResource($this->owner),
            // 'currency_id' => $this->currency_id,
            'currency' => new \App\Http\Resources\Currency\CurrencyResource($this->currency),
            // 'wallet_id' => $this->wallet_id,
            "wallet" => new \Modules\RealEstate\Transformers\RlstWalletResource($this->wallet),
            // 'unit_status_id' => $this->unit_status_id,
            // "unit_status" => new RlstUnitStatusResource($this->unitStatus),
            "unit_status" => new RlstUnitStatusResource($this->unitStatus),
            'commission_ty' => $this->commission_ty,
            'commission_value' => $this->commission_value,
            'price' => $this->price,
            'rooms' => $this->rooms,
            'path' => $this->path,
            'view' => $this->view,
            'floor' => $this->floor,
            'rank' => $this->rank,
            'properties' => $this->properties,
            'attachments' => $this->attachments,
            'module' => $this->module,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
