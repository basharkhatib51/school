<?php


namespace App\Http\Requests\Generated\Notification;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class UpdateNotificationRequest extends FormRequest
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
           'title' => "string|max:191|required",
'content' => "required",

           'class_levels'=> "nullable|exists:class_levels,id",
'classroom'=> "nullable|exists:classrooms,id",

        ];
    }
}
