<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThanhToanRequest extends FormRequest
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
                                    'ngay_thanh_toan' => 'required | date | after_or_equal:today',
                                    'gia' => 'required | numeric|min:1000',
                                    'id_phuong_thuc_thanh_toan' => 'numeric|min:1',
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $rules = [
                                    'ngay_thanh_toan' => 'required | date | after_or_equal:today',
                                    'gia' => 'required | numeric|min:1000',
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
            'ngay_thanh_toan.required' => 'Ngày thanh toán bắt buộc phải nhập',
            'ngay_thanh_toan.after_or_equal' => 'Ngày thanh toán không thể trước ngày hôm nay',
            'id_phuong_thuc_thanh_toan.min' => 'Phương thức thanh toán bắt buộc phải chọn',
            'gia.required' => 'Giá bắt buộc phải nhập',
            'gia.min' => 'Giá không thể nhỏ hơn 1000',
        ];
    }
}
