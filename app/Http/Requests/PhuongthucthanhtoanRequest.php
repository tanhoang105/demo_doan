<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhuongthucthanhtoanRequest extends FormRequest
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
                                    'ten' => 'required | unique:phuong_thuc_thanh_toan,ten',
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ten' => 'required',
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
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại'

        ];
    }

    public function attributes()
    {
        return [

            'ten' => 'Tên hính thức thnah toán',
        ];
    }
}
