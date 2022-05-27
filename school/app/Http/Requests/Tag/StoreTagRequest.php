<?php


namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreTagRequest extends FormRequest
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
            'name' => "string|max:191|required|unique:tags,name",
            'name_ar' => "nullable|string|max:191|unique:tags,name_ar",
            'name_tr' => "nullable|string|max:191|unique:tags,name_tr",


        ];
    }
}
