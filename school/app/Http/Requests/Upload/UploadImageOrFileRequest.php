<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageOrFileRequest extends FormRequest
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
            'file'=>'required|file|mimes:jpg,bmp,png,webp,pdf|mimetypes:image/jpeg,image/png,image/webp,image/bmp,application/pdf|max:5000'
        ];
    }
}
