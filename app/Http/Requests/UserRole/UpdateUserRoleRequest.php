<?php

namespace App\Http\Requests\UserRole;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRoleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "role_id" => "required|exists:general_roles,id",
            'user_id' => "required|exists:general_users,id",
        ];
    }

}
