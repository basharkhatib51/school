<?php


namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class StoreMenuRequest extends FormRequest
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
            'title' => "string|max:191|required|unique:menus,title",
            'type' => "in:url,page,post,project,route|required",
            'url' => "required",

            'post' => "nullable|exists:posts,id",
            'page' => "nullable|exists:pages,id",
            'project' => "nullable|exists:projects,id",

        ];
    }
}
