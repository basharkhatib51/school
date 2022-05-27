<?php


namespace App\Http\Requests\Tcp;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class SendMessageRequest extends FormRequest
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
            'message' => "required|max:1000",
        ];
    }
}