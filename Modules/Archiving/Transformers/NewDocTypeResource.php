<?php

namespace Modules\Archiving\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Archiving\Entities\DocTypeField;

class NewDocTypeResource extends JsonResource
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
            'name' => $this->name,
            'name_e' => $this->name_e,
            'is_valid' => $this->is_valid,
            'parent_id' => new DocRelationResource($this->parent),
            'doc_type_field' => DocTypeFieldResource::collection(DocTypeField::where('doc_type_id', $this->id)->get()),
            "company_id" => $this->company_id,
        ];
    }
}
