<?php


namespace App\Http\Requests\Generated\Program;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreProgramRequest extends FormRequest
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
            'start_at' => "date_format:h:i:s|required",
            'finish_at' => "date_format:h:i:s|required",
            'day' => "in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday, Sunday|required",
            'subject_registration' => "required|exists:subject_registrations,id",

        ];
    }
}
