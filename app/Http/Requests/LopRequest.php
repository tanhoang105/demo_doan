<?php

namespace App\Http\Requests;

use App\Models\GiangVien;
use App\Models\Lop;
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
        $data = $this->all();
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 
        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // nếu là method thêm mới bản ghi
                    case 'store':
                        $rules = [
                            'ten_lop' => 'required | unique:lop,ten_lop',
                            'id_giang_vien' => 'numeric | min:1',
                            'ca_thu_id' => 'required', [
                                function ($attribute, $value, $fali) use ($data) {

                                    $check_trung = Lop::where('id_giang_vien', '=', $data['id_giang_vien'])
                                        ->where('ca_thu_id', '=', $value)
                                        // ->where($data['ngay_bat_dau'],'<','lop.ngay_ket_thuc')
                                        ->get();
                                    // dd($check_trung);
                                    if ($check_trung->count() > 0) {
                                        return $fali('Ca học đã bị trung lịch của giang viên đã chọn.');
                                    }
                                }
                            ],
                            'id_khoa_hoc' => 'numeric|min:1',
                            'ngay_bat_dau' => 'required | date | after:today',
                            'thoi_gian' => 'required | numeric | min:1'
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ten_lop' => 'required',
                            'id_khoa_hoc' => 'numeric|min:1',
                            'id_giang_vien' => 'numeric|min:1',
                            'so_luong' => 'required',
                            'ngay_bat_dau' => 'required | date | after:today',
                            'ngay_ket_thuc' => [
                                function ($attribute, $value, $fali) use ($data) {
                                    if($value < $data['ngay_bat_dau']){
                                        return $fali('ngày bắt đầu không  được nhỏ hơn ngày kết thúc');
                                    }
                                }
                            ]
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
            'min' => ':attribute ít hơn kí tự tối thiểu',
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute vượt quá kí tự cho phép',
            'min' => ':attribute không được nhỏ hơn 0',
            'after' => ':attribute không được nhỏ hơn hoặc bằng ngày hôm nay',
            'integer' => ':attribute định dạng bắt buộc là số',
            // 'numeric' => ':attribute định dạng bắt buộc là số',
            'ca_thu_id.required' => 'Lịch học không được để trống',
            // 'ten_lop.regex' => 'Tên lớp chứa ký tự không hợp lệ',
            'id_khoa_hoc.min' => 'Khóa học bắt buộc phải chọn',
            'id_giang_vien.min' => 'Giảng viên bắt buộc phải chọn',
            'ca_thu_id.min' => 'Vai trò bắt buộc phải chọn',
            'thoi_gian.required' => 'Thời gian bắt buộc phải nhập',
            'thoi_gian.numeric' => 'Thời gian sai định dạng',
            'thoi_gian.min' => 'Thời gian không thể nhỏ hơn 1',
        ];
    }
    public function attributes()
    {
        return [
            'ten_lop' => 'Tên lớp',
            'ca_thu_id' => 'Ca thứ',
            'so_luong' => 'Số lượng ghế',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'ngay_ket_thuc' => 'Ngày kết thúc',
        ];
    }
}
