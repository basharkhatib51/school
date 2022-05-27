<?php

namespace App\Http\Requests\Student;

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
//            'email' => 'nullable|email|unique:users,email',
            'model_number' => 'required|numeric|unique:users,model_number',
            'phone' => 'nullable',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'password' => ['required', Password::default()], //'confirmed',
            'family_first_name' => 'required',
//            'family_last_name' => 'required',
            'family_email' => 'nullable|email|unique:users,email',
            'family_phone' => 'required',
            'family_password' => ['required', Password::default()], //'confirmed',
        ];
    }
}
