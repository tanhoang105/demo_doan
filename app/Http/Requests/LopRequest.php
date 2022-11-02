<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LopRequest extends FormRequest
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
                            'ten_lop' => 'required | unique:lop,ten_lop',
                            // 'mo_ta' => 'required | min:20 |',
                            'gia' => 'required | integer | max:10000000',
                            'so_luong' => 'required | integer | max:40',
                            'ngay_bat_dau' => 'required | after:now',
                            'ngay_ket_thuc' => 'required | after:ngay_bat_dau'
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ten_lop' => 'required',
                            // 'mo_ta' => 'required | min:20 |',
                            'gia' => 'required | integer | max:10000000',
                            'so_luong' => 'required | integer | max:40',
                            // 'ngay_bat_dau' => 'required | after:now',
                            // 'ngay_ket_thuc' => 'required | after:ngay_bat_dau'
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
            'min' => ':attribute lớn hơn 3 ký tự',
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute vượt quá kí tự cho phép',
            'after' => ':attribute không được nhỏ hơn ngày bắt đầu',
            'integer' => ':attribute định dạng bắt buộc là số'
        ];
    }
    public function attributes()
    {
        return [
            'ten_lop' => 'tên lớp',
            'gia' => 'Giá tiền',
            'so_luong' => 'Số lượng',
            'ngay_bat_dau' => 'ngày bắt đầu',
            'ngay_ket_thuc' => 'ngày kết thúc',
        ];
    }
}
