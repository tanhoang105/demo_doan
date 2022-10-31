<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhonghocRequest extends FormRequest
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
                            'ten_phong' => 'required | min:4 | unique:phong_hoc,ten_phong',
                        ];
                        break;

                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ten_phong' => 'required | min:4',
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
            'min' => ':attribute lớn hơn 4 ký tự',
            'unique' => ':attribute đã tồn tại'

        ];
    }

    public function attributes()
    {
        return [

            'ten_phong' => 'Tên phòng học',
        ];
    }
}
