<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'name'=>'required',
            'file'=>'required|file|mimes:pdf|mimetypes:application/pdf|max:10240'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>"your file doesn’t have name",
        ];
    }
}
