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
                                    'ten_khoa_hoc' => 'required | unique:khoa_hoc,ten_khoa_hoc',
                                    'id_danh_muc' => 'numeric|min:1',
                                    'gia_khoa_hoc' => 'required | numeric|min:1000',
                                    // 'hinh_anh' => 'required',
                                    'tien_to' => 'required'
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ten_khoa_hoc' => 'required',
                                    'gia_khoa_hoc' => 'required | numeric|min:1000',
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
            'id_danh_muc.min' => 'Danh mục bắt buộc phải chọn',
            'gia_khoa_hoc.required' => 'Giá tiền bắt buộc phải nhập',
            'gia_khoa_hoc.min' => 'Giá tiền không được nhỏ hơn 1000',
        ];
    }

    public function attributes()
    {
        return [
            'ten_khoa_hoc' => 'Tên khóa học',
            'ten_danh_muc' => 'Khóa học',
            'mo_ta' => 'Mô tả',
            'hinh_anh' => 'Hình ảnh',
            'tien_to' => 'Tiền tố',
        ];
    }
}
