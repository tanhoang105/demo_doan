<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoimatkhauRequest extends FormRequest
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
                    case 'store':
                        $rules = [
                            'old_password' => 'required',
                            'new_password' => 'required',
                            'password_confirmation' => 'required | same:new_password',
                        ];
                        break;

                    // nếu là method chỉnh sửa bản ghi
                    case 'update_password':
                        $rules = [
                            'old_password' => 'required',
                            'new_password' => 'required ',
                            'password_confirmation' => 'required | same:new_password'
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
           'old_password.required' => 'Bắt buộc nhập mật khẩu cũ',
           'new_password.required' => 'Bắt buộc nhập mật khẩu mới ',
           'password_confirmation.required' => 'Bắt buộc nhập nhập lại mật khẩu',
           'password_confirmation.same' => 'Mật khẩu không giống nhau',
        ];
    }
}
