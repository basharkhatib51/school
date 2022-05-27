<?php


namespace App\Http\Requests\Generated\ClassLevel;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class StoreClassLevelRequest extends FormRequest
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

           
        ];
    }
}
