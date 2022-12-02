<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaHocRequest extends FormRequest
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
        $ActionCurrent = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                    case 'store':
                        $rules = [
                            'ca_hoc' => 'required | unique:ca_hoc,ca_hoc',
                            'thoi_gian_bat_dau' => 'required | unique:ca_hoc,thoi_gian_bat_dau',
                            'thoi_gian_ket_thuc' => 'required | after:thoi_gian_bat_dau',
                        ];
                        break;
                    case 'update':
                        $rules = [
                            'ca_hoc' => 'required',
                            'thoi_gian_bat_dau' => 'required',
                            'thoi_gian_ket_thuc' => 'required',
                        ];
                        break;
                    default:
                        break;
                }
                break;                                        
            default:
                break;
        }
        return $rules;
    }
    // 
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại',
            'thoi_gian_ket_thuc.after' => ':attribute không thể trước thời gian bắt đầu',
        ];
    }
    // 
    public function attributes()
    {
        return [

            'ca_hoc' => 'Ca học',
            'thoi_gian_bat_dau' => 'Thời gian bắt đầu',
            'thoi_gian_ket_thuc' => 'Thời gian kết thúc',
        ];
    }
}
