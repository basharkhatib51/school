<?php


namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class  UpdatePageRequest extends FormRequest
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
            'title' => "string|max:191|required|unique:pages,title,$this->id",
            'image' => "exists:uploads,id|nullable",
            'background' => "exists:uploads,id|nullable",
            'content' => "required",
            'excerpt' => "nullable",
            'layout' => "in:full,without_menu|nullable",
            'status' => "in:published,waiting_for_review|required",
            'tags' => "nullable|exists:tags,id",

        ];
    }
}
