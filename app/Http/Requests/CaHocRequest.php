<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaHocRequest extends FormRequest
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
        $rules = [];
        $ActionCurrent = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                    case 'store':
                        $rules = [
                            'ca_hoc' => 'required',
                        ];
                        break;
                    case 'update':
                        $rules = [
                            'ca_hoc' => 'required',
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        return $rules;
    }
    // 
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
        ];
    }
    // 
    public function attributes()
    {
        return [

            'ca_hoc' => 'Ca học',
        ];
    }
}
