<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuHocRequest extends FormRequest
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
                                    'ma_thu' => 'required | unique:thu_hoc',
                                    'ten_thu' => 'required | unique:thu_hoc',
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ma_thu' => 'required',
                                    'ten_thu' => 'required',
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
            'ma_thu.required' => 'Mã thứ bắt buộc phải nhập',
            'ten_thu.required' => 'Tên thứ bắt buộc phải nhập',
            'ma_thu.unique' => 'Mã thứ này đã tồn tại',
            'ten_thu.unique' => 'Tên thứ thứ này đã tồn tại',
        ];
    }
}
