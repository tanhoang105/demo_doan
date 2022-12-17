<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDoiLopClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_lop_moi' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'id_lop_moi.required' => 'Lớp mới không được để trống',
        ];
    }
}
