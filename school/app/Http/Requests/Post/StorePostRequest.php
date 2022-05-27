<?php


namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StorePostRequest extends FormRequest
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
            'title' => "string|max:191|required|unique:posts,title",
            'image' => "exists:uploads,id|nullable",
            'background' => "exists:uploads,id|nullable",
            'content' => "required",
            'excerpt' => "required",
            'tags' => "nullable|exists:tags,id",

        ];
    }
}
