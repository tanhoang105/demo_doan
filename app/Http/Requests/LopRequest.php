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
                            'id_giang_vien' => 'numeric|min:1',
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
                            'thoi_gian' => 'required | numeric'
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ten_lop' => 'required',
                            'id_giang_vien' => 'numeric|min:1',
                            'ca_thu_id' => [
                                function ($attribute, $value, $fali) use ($data) {
                                    $check_trung = Lop::where('id_giang_vien', '=', $data['id_giang_vien'])
                                        ->where('ca_thu_id', '=', $value)
                                        ->get();
                                    // dd($check_trung);
                                    if ($check_trung->count() > 0) {
                                        return $fali('Ca học đã bị trung lịch của giang viên đã chọn.');
                                    }
                                }
                            ],
                            'id_khoa_hoc' => 'numeric|min:1',
                            'ngay_bat_dau' => 'required | date | after:today',
                            'thoi_gian' => 'required | numeric'
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
            'integer' => ':attribute định dạng bắt buộc là số',
            'numeric' => ':attribute định dạng bắt buộc là số',
            'ca_thu_id.required' => 'Lịch học không được để trống'
        ];
    }
    public function attributes()
    {
        return [
            'ten_lop' => 'Tên lớp',
            // 'ca_thu_id' => 'Ca thứ',
            'so_luong' => 'Số lượng ghế',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'ngay_ket_thuc' => 'Ngày kết thúc',
        ];
    }
}
