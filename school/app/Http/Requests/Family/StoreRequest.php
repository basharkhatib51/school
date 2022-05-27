<?php

namespace App\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
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
            'last_name' => 'required',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'password' => ['required', Password::default()], //'confirmed',
        ];
    }
}
