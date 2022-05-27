<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required|string',
            'email' => "required|email|unique:users,email",
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'required',
            'language' => 'required|in:english,arabic,turkish',
            'link' => 'required',
        ];
    }
}
