<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuenMatKhauRequest extends FormRequest
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
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                    // nếu là method thêm mới bản ghi
                    case 'submitForgetPasswordForm':
                        $rules = [
                            'email' => 'required|email|exists:users',
                        ];
                        break;

                    // nếu là method chỉnh sửa bản ghi
                    case 'submitResetPasswordForm':
                        $rules = [
                            'email' => 'required|email|exists:users',
                            'password' => 'required|confirmed',
                            'password_confirmation' => 'required | same:password'
                        ];
                        break;

                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }
        return $rules ;
    }

    public function messages()
    {
        return [
           'email.required' => 'Bắt buộc nhập Email',
           'email.email' => 'Sai định dạng Email',
           'email.exists' => 'Email chưa được đăng ký',
           'password.required' => 'Bắt buộc nhập mật khẩu mới ',
           'password.confirmed' => 'Xác nhận mật khẩu không khớp',
           'password_confirmation.required' => 'Bắt buộc nhập nhập lại mật khẩu',
           'password_confirmation.same' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}

