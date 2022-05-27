<?php


namespace App\Http\Requests\Tcp;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreExamRequest extends FormRequest
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
            'date' => "date_format:Y-m-d|required",
            'percentage' => "integer|required|max:100",
            'type' => "required",
            'subject_registration' => "required|exists:subject_registrations,id",

        ];
    }
}
