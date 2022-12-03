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
                            'id_giang_vien' => 'numeric|min:1',
                            'ca_thu_id' => 'numeric|min:1',
                            'id_khoa_hoc' => 'numeric|min:1',
                            'so_luong' => 'required | integer | min:1 | max:40',
                            'ngay_bat_dau' => 'required | date | after:today',
                            'ngay_ket_thuc' => 'required | date | after:ngay_bat_dau',
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ten_lop' => 'required',
                            'id_giang_vien' => 'numeric|min:1',
                            'ca_thu_id' => 'numeric|min:1',
                            'id_khoa_hoc' => 'numeric|min:1',
                            'so_luong' => 'required | integer | min:1 | max:40',
                            'ngay_bat_dau' => 'required | date | after:today',
                            'ngay_ket_thuc' => 'required | date | after:ngay_bat_dau',
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
            'min' => ':attribute không được nhỏ hơn 0',
            'ngay_bat_dau.after' => ':attribute không được nhỏ hơn hoặc bằng ngày hôm nay',
            'ngay_ket_thuc.after' => ':attribute không được nhỏ hơn hoặc bằng ngày bắt đầu',
            'id_giang_vien.min' => 'Giảng viên bắt buộc phải chọn',
            'ca_thu_id.min' => 'Lịch học bắt buộc phải chọn',
            'id_khoa_hoc.min' => 'Khóa học bắt buộc phải chọn',
            'integer' => ':attribute định dạng bắt buộc là số'
        ];
    }
    public function attributes()
    {
        return [
            'ten_lop' => 'Tên lớp',
            'so_luong' => 'Số lượng ghế',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'ngay_ket_thuc' => 'Ngày kết thúc',
        ];
    }
}
