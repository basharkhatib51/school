<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'file'=>'required|image|file|mimes:jpg,bmp,png,webp|mimetypes:image/jpeg,image/png,image/webp,image/bmp|max:1024'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>"your file doesn’t have name",
        ];
    }
}
