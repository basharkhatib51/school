<?php

namespace App\Http\Requests\Authenticate;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'login_type' => 'required|in:0,1,2,3',
            'user_name' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return ['exists'=>"You have entered an invalid email or password"];
    }
}
