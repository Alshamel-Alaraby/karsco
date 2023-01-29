<?php

namespace Modules\Archiving\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArchiveFileRequest extends FormRequest
{
    use ValidationTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "arch_doc_type_id" => "required|exists:arch_doc_types,id",
            "data_type_value" => "required",
            "user_id" => "nullable|exists:users,id",
            // "media.*" => ["exists:media,id", new \App\Rules\MediaRule()],
            // 'old_media.*' => ['exists:media,id', new \App\Rules\MediaRule("Modules\Archiving\Entities\DocStatus")],
        ];
    }

}
