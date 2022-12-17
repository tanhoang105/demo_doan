<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChinhSachRequest extends FormRequest
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
                            'noi_dung' => 'required',
                            'doi_tuong_ap_dung' => 'required',
                        ];
                        break;

                    // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'noi_dung' => 'required',
                            'doi_tuong_ap_dung' => 'required',
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
            'noi_dung.required' => 'Bắt buộc phải nhập nội dung',
            'doi_tuong_ap_dung.required' => 'Bắt buộc phải nhập đối tượng áp dụng',
        ];
    }

}
