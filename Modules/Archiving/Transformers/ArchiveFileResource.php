<?php

namespace Modules\Archiving\Transformers;

use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchiveFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $favourite = null;
        $user_id = request()->user_id;
        $admin_id = request()->admin_id;
        if ($user_id) {
            $favourite = $this->favourites()->where("user_id", $user_id)->first();
        } elseif ($admin_id) {
            $favourite = $this->favourites()->where("admin_id", $admin_id)->first();
        }

        return [
            'id' => $this->id,
            "data_type_value" => $this->data_type_value,
            "media" => isset($this->files) ? FileResource::collection($this->files) : null,
            "favourite" => $favourite ? true : false,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            "media_count" => count((array) $this->files),
        ];

    }
}
