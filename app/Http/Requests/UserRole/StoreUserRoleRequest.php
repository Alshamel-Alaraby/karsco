<?php

namespace App\Http\Requests\UserRole;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRoleRequest extends FormRequest
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
            "role" => "required|exists:general_roles,id",
            "users" => "required|array",
            "users.*" => "required|exists:general_users,id|unique:general_role_user,user_id",
        ];
    }

}
