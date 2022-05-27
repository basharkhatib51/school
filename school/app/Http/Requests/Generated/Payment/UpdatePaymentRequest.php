<?php


namespace App\Http\Requests\Generated\Payment;

use Illuminate\Foundation\Http\FormRequest;
//{{ use }}
class UpdatePaymentRequest extends FormRequest
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

           'student_registration'=> "required|exists:student_registrations,id",

        ];
    }
}
