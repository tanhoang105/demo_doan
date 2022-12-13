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
        // $rules = [];
        // $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 

        // switch ($this->method()) {
        //     case 'POST':
        //         switch ($ActionCurrent) {
        //                 // nếu là method thêm mới bản ghi
        //             case 'store':
        //                 $rules = [
        //                     'ngay_dang_ky' => 'required | after:today',
        //                     'id_lop' => 'numeric|min:1',
        //                     'id_phong_hoc' => 'numeric|min:1',

        //                     // 'id_lop' => [
        //                     //     function ($attribute, $value, $fali) {
        //                     //         $data = XepLop::all();
        //                     //         // dd(1);
        //                     //         foreach ($data as $item) {
        //                     //             // dd(2);
        //                     //             if ($value == $item->id_lop) {
        //                     //                 if ($item->ngay_dang_ky == date('ngay_dang_ky')) {
        //                     //                     dd(4);
        //                     //                 }
        //                     //                 dd(date("ngay_dang_ky"));
        //                     //                 dd(3);
        //                     //                 return $fali('lớp đã tồn tại!');
        //                     //             }
        //                     //         }
        //                     //     }
        //                     // ]
        //                 ];
        //                 break;
        //                 // nếu là method chỉnh sửa bản ghi
        //             case 'update':
        //                 $rules = [
        //                     'ngay_dang_ky' => 'required | after:today',
        //                     'id_lop' => 'numeric|min:1',
        //                     'id_phong_hoc' => 'numeric|min:1',
        //                 ];
        //                 break;

        //             default:
        //                 # code...
        //                 break;
        //         }
        //         break;

        //     default:
        //         # code...
        //         break;
        // }
        // return $rules;

        $data = $this->all();
        //dd($data);
        return [
            'ngay_dang_ky' => [],
            'id_lop' => [],
            'id_phong_hoc' => [
                function ($attribute, $value, $fali) use ($data) {
                    if ($value === null || !isset($data['id_lop'])) {
                        return;
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
    }


    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'ngay_dang_ky.after' => 'Ngày đăng ký phải từ sau ngày hôm nay',
            'id_lop.min' => 'Lớp bắt buộc phải chọn',
            'id_phong_hoc.min' => 'Phòng học bắt buộc phải chọn',
        ];
    }

    public function attributes()
    {
        return [

            'ngay_dang_ky' => 'Ngày đăng kí',
        ];
    }
}
