<?php


namespace App\Http\Requests\Generated\Fee;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class UpdateFeeRequest extends FormRequest
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
           'value' => "integer|required",

           'class_level'=> "required|exists:class_levels,id",
'year'=> "required|exists:years,id",

        ];
    }
}
