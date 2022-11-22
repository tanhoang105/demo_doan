<?php

namespace App\Http\Requests;

use App\Models\XepLop;
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
                        $rules = [
                            'ngay_dang_ky' => 'required | after:today',
                            // 'id_lop' => [
                            //     function ($attribute, $value, $fali) {
                            //         $data = XepLop::all();
                            //         // dd(1);
                            //         foreach ($data as $item) {
                            //             // dd(2);
                            //             if ($value == $item->id_lop) {
                            //                 if ($item->ngay_dang_ky == date('ngay_dang_ky')) {
                            //                     dd(4);
                            //                 }
                            //                 dd(date("ngay_dang_ky"));
                            //                 dd(3);
                            //                 return $fali('lớp đã tồn tại!');
                            //             }
                            //         }
                            //     }
                            // ]
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'ngay_dang_ky' => 'required | after:today',
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
            'after' => 'thông tin :attribute sai'

        ];
    }

    public function attributes()
    {
        return [

            'ngay_dang_ky' => 'ngày đăng kí',
        ];
    }
}
