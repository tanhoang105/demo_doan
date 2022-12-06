<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangkyTKRequest extends FormRequest
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
                            'name' => 'required',
                            'email' => 'required | email | unique:users,email',
                            'password' => 'required',
                            'sdt' => 'required | min:10 | max:11',
                            'dia_chi' => 'required | max:100',
                        ];
                        break;
                        // case 'update':
                        $rules = [
                            'ca_hoc' => 'required',
                            'thoi_gian_bat_dau' => 'required',
                            'thoi_gian_ket_thuc' => 'required',
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
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'min' => ':attribute không đúng',
            'max' => ':attribute vượt quá kí tự cho phép',
            'unique' => ':attribute đã tồn tại',
        ];
    }
    // 
    public function attributes()
    {
        return [

            'name' => 'Tên học viên',
            'email' => 'email',
            'password' => 'mật khẩu',
            'sdt' => 'số điện thoại',
            'dia_chi' => 'địa chỉ',
        ];
    }
}
