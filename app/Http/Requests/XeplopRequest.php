<?php

namespace App\Http\Requests;

use App\Models\PhongHoc;
use App\Models\XepLop;
use App\Models\Lop;
use Illuminate\Foundation\Http\FormRequest;

class XeplopRequest extends FormRequest
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
                        $data = $this->all();
                        $rules = [
                            'ngay_dang_ky' => 'required | after:today',
                            'id_lop' =>'required',
                            'id_phong_hoc' => [

                                function ($attribute, $value, $fali) use ($data) {
                                    if ($value === null || !isset($data['id_lop'])) {
                                        return $fali('Phòng học không được để trống');
                                    }
                                    $lop = Lop::find($data['id_lop']);
                                    //dd(XepLop::with('lop')->get());
                                    $phong = XepLop::where('id_phong_hoc', $value)->whereHas('lop', function ($q) use ($lop) {
                                        $q->where('ca_thu_id', $lop['ca_thu_id']);
                                    })->get();
                                    if ($phong->count() > 0) {
                                        return $fali('Phòng học đã bị chiếm dụng. Vui lòng chọn lại.');
                                    }
                                }
                            ]
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $data = $this->all();
                        $rules = [
                            'ngay_dang_ky' => 'required | after:today',
                            'id_lop' => 'required',
                            'id_phong_hoc' => 'required', [
                                function ($attribute, $value, $fali) use ($data) {
                                    if ($value === null || $data['id_lop']) {
                                        return;
                                    }
                                    $lop = Lop::find($data['id_lop']);
                                    // dd(1);
                                    // dd(XepLop::with('lop')->get());
                                    $phong = XepLop::where('id_phong_hoc', $value)->whereHas('lop', function ($q) use ($lop) {
                                        $q->where('ca_thu_id', $lop['ca_thu_id']);
                                    })->get();
                                    if ($phong->count() > 0) {
                                        return $fali('Phòng học đã bị chiếm dụng. Vui lòng chọn lại.');
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

        // $data = $this->all();
        //dd($data);
        // return [
        //     'ngay_dang_ky' => [],
        //     'id_lop' => [],
        //     'id_phong_hoc' => [
        //         function ($attribute, $value, $fali) use ($data) {
        //             if ($value === null || !isset($data['id_lop'])) {
        //                 return;
        //             }
        //             $lop = Lop::find($data['id_lop']);
        //             //dd(XepLop::with('lop')->get());
        //             $phong = XepLop::where('id_phong_hoc', $value)->whereHas('lop', function ($q) use ($lop) {
        //                 $q->where('ca_thu_id', $lop['ca_thu_id']);
        //             })->get();
        //             if ($phong->count() > 0) {
        //                 return $fali('Phòng học đã bị chiếm dụng. Vui lòng chọn lại.');
        //             }
        //         }
        //     ]
        // ];
    }


    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'after' => ':attribute phải từ sau ngày hôm nay',
            'min' => ':attribute quá ít kí tự',
            // 'id_phong_hoc.min' => 'attribute bắt buộc phải chọn',
        ];
    }

    public function attributes()
    {
        return [
            'ngay_dang_ky' => 'Ngày đăng kí',
            'id_lop' => 'Lớp',
            'id_phong_hoc' => 'Phòng học'
        ];
    }
}
