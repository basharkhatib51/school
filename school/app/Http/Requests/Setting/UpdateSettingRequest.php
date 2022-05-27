<?php


namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

//{{ use }}
class UpdateSettingRequest extends FormRequest
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
            'key' => "string|max:191|required|unique:settings,key,$this->id|max:191",
            'value' => "nullable",
            'default' => "nullable",
            'option' => "nullable",
            'type' => "in:number,text,string,image,boolean,enum|required",
            'pack' => "in:fas,fab,far,feather|nullable",
            'icon' => "string|max:191|nullable|max:191",
            'tab' => "string|required|max:191",
            'index' => "integer|nullable",


        ];
    }
}
