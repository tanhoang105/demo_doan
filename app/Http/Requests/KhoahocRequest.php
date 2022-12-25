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
                                    'id_danh_muc' => 'numeric | min:1',
                                    'gia_khoa_hoc' => 'required | numeric | min:1000',
                                    'hinh_anh' => 'required | image',
                                    'tien_to' => 'required | regex:/^[a-zA-Z ]+$/',
                                    'mo_ta' => 'required',
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ten_khoa_hoc' => 'required',
                                    'gia_khoa_hoc' => 'required | numeric | min:1000',
                                    'tien_to' => 'required | regex:/^[a-zA-Z ]+$/',
                                    'hinh_anh' => 'required | image',
                                    'mo_ta' => 'required',
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
            'ten_khoa_hoc.required' => 'Tên khóa học bắt buộc phải nhập',
            'ten_khoa_hoc.unique' => 'Tên khóa học đã tồn tại',
            'gia_khoa_hoc.required' => 'Giá khóa học bắt buộc phải nhập',
            'gia_khoa_hoc.numeric' => 'Giá khóa học sai định dạng',
            'tien_to.required' => 'Tên tiền tố bắt buộc phải nhập',
            'tien_to.regex' => 'Tên tiền tố chứa ký tự không hợp lệ',
            'hinh_anh.required' => 'Hình ảnh bắt buộc phải có',
            'hinh_anh.image' => 'Ảnh khóa học phải có định dạng: jpeg, png, jpg',
            'mo_ta.required' => 'Mô tả bắt buộc phải nhập',
            'id_danh_muc.min' => 'Danh mục bắt buộc phải chọn',
            'gia_khoa_hoc.min' => 'Giá tiền không được nhỏ hơn 1000',
            'min' => ':attribute lớn hơn 20 ký tự',
        ];
    }

}
