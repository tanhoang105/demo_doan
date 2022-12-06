<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class KhuyenmaiRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // nếu là method thêm mới bản ghi
                    case 'store':
                        $rules = [
                            'ma_khuyen_mai' => 'required|unique:khuyen_mai,ma_khuyen_mai',
                            // 'mo_ta' => 'required | min:20 |',
                            'loai_khuyen_mai' => 'required',
                            'giam_gia' => 'required | integer | max:100',
                            'ngay_bat_dau' => 'required | after:now',
                            'ngay_ket_thuc' => 'required | after:ngay_bat_dau'
                        ];
                        break;

                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $id = $request->id;
                        // dd($id);
                        $rules = [
                            // 'mo_ta' => 'required | min:20 |',
                            'ma_khuyen_mai' => 'required|min:3|max:30|unique:khuyen_mai,ma_khuyen_mai,'.$id,
                            'loai_khuyen_mai' => 'required',
                            'giam_gia' => 'required | integer | max:100',
                            'ngay_bat_dau' => 'required | after:today',
                            'ngay_ket_thuc' => 'required | after:ngay_bat_dau',
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
            'after:today' => ':ngày bắt đầu không chính xác',
            'after' => ':attribute không được nhỏ hơn ngày bắt đầu',
            'integer' => ':attribute định dạng bắt buộc là số'
        ];
    }

    public function attributes()
    {
        return [

            'ma_khuyen_mai' => 'Mã khuyến mại',
            'mo_ta' => 'Mô tả',
            'loai_khuyen_mai' => 'loại khuyến mại',
            'giam_gia' => 'giảm giá',
            'ngay_ket_thuc' => 'ngày kết thúc'

        ];
    }
}
