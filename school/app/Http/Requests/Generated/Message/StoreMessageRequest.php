<?php


namespace App\Http\Requests\Generated\Message;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class StoreMessageRequest extends FormRequest
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
           'content' => "required",
'sender_type' => "in:student,teacher|required",
'reciver_type' => "in:subject,student,teacher|required",
'image' => "exists:uploads,id|nullable",

           'student'=> "nullable|exists:students,id",
'teacher'=> "nullable|exists:teachers,id",
'subject_registration'=> "nullable|exists:subject_registrations,id",

        ];
    }
}
