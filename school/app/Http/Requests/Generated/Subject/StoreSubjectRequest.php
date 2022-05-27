<?php


namespace App\Http\Requests\Generated\Subject;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreSubjectRequest extends FormRequest
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
            'name' => "string|max:191|required",
            'semester' => "in:first,second|required",
            'percentage' => "required|numeric",
            'class_level' => "required|exists:class_levels,id",

        ];
    }
}
