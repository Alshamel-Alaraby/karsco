<?php

namespace Modules\Archiving\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ToggleFavouriteRequest extends FormRequest
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
            "arch_archive_file_id" => "required|exists:arch_archive_files,id",
            "user_id" => "nullable|exists:general_users,id",
            "type" => "required|in:admin,user"
        ];
    }

}
