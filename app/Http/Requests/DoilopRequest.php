<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoilopRequest extends FormRequest
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
        $data = $this->all();
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 
        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // nếu là method thêm mới bản ghi
                    case 'store':
                        $rules = [
                            'id_user' => 'required',
                            'id_lop_cu' => 'required',
                            'id_khoa_hoc' => 'required',
                            'id_lop_moi' => 'required',
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
        return $rules;
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
        ];
    }
    public function attributes()
    {
        return [
            'id_user' => 'Mã sinh viên',
            'id_lop_cu' => 'Khóa học cũ',
            'id_khoa_hoc' => 'Khóa học mới',
            'id_lop_moi' => 'Lớp mới',
        ];
    }
}
