<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => "required|email|unique:users,email,$user->id",
            'phone' => 'required',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
        ];
    }
}
