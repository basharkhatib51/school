<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'email' => "required|email|unique:users,email,{$this->teacher->id}",
            'model_number' => "required|numeric|unique:users,model_number,{$this->teacher->id}",
            'phone' => "nullable",
        ];
    }
}
