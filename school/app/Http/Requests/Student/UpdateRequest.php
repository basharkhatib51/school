<?php

namespace App\Http\Requests\Student;

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
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'model_number' => "required|numeric|unique:users,model_number,{$this->student->id}",
            'phone' => 'nullable',
            'family_first_name' => 'required',
//            'family_last_name' => 'required',
            'family_email' => "nullable|email|unique:users,email,{$this->student->family->id}",
            'family_phone' => 'required',
        ];
    }
}
