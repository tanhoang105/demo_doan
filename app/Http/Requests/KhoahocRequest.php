<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoahocRequest extends FormRequest
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
                                    'ten_khoa_hoc' => 'required | min:3 | max:50 | unique:khoa_hoc,ten_khoa_hoc',
                                  
                                    'hinh_anh' => 'required'
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ten_khoa_hoc' => 'required | min:3 | max:50 ',
                                    // 'mo_ta' => 'required | min:20 |',
                                    // 'hinh_anh' => 'required'
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
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute lớn hơn 20 ký tự',
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute vượt quá kí tự cho phép',
        ];
    }

    public function attributes()
    {
        return [

            'ten_danh_muc' => 'Khóa học',
            'mo_ta' => 'Mô tả',
            'hinh_anh' => 'hình ảnh',

        ];
    }
}
