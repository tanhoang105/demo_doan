<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $ActionCurrent = $this->route()->getActionMethod(); // tra ve Method dang hoat dong 

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // method loggin
                    case 'login':
                        $rules = [
                            'email' => 'required | email | max:255',
                            'password' => 'required | min:6'
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
    public function messages()
    {
        return [
            'email.mail' => 'email không được vượt quá 255 kí tự',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Sai định dạng Email',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Mật khẩu bắt buộc nhiều hơn 6 ký tự',
        ];
    }
}
