<?php


namespace App\Http\Requests\Generated\Subject;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class FilterSubjectRequest extends FormRequest
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
            'class_level' => "required|exists:class_levels,id",
            'classroom' => "required|exists:classrooms,id",
            'semester' => "required|in:second,first",
        ];
    }
}
