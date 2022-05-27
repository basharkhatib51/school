<?php


namespace App\Http\Requests\Tcp;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreResultRequest extends FormRequest
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
            'exam_id' => "required|exists:exams,id",
            'student_id' => "required|exists:users,id",
            'value' => "required",
        ];
    }
}
