<?php


namespace App\Http\Requests\Tcp;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreResultsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $this->message='sd';
        $this->errorBag='sdssss';
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
            'results.*.student_id' => "required|exists:users,id",
            'results.*.value' => "required",
        ];
    }
}
