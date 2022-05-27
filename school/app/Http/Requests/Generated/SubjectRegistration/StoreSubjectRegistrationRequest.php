<?php


namespace App\Http\Requests\Generated\SubjectRegistration;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreSubjectRegistrationRequest extends FormRequest
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
            'subject' => "required|exists:subjects,id",
            'classroom' => "required|exists:classrooms,id",
            'teacher' => "required|exists:users,id",
        ];
    }
}
