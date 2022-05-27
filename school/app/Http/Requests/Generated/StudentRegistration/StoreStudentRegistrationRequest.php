<?php


namespace App\Http\Requests\Generated\StudentRegistration;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreStudentRegistrationRequest extends FormRequest
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
            'student' => "required|exists:users,id",
            'classroom' => "required|exists:classrooms,id",
        ];
    }
}
