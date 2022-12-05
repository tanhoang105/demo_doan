<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
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
                            'thoi_gian_ket_thuc' => 'required | after:thoi_gian_bat_dau|unique:ca_hoc,thoi_gian_ket_thuc',
                        ];
                        break;
                    case 'update':
                        $id = $request->id;

                        $rules = [
                            'ca_hoc' => 'required | unique:ca_hoc,ca_hoc,'.$id,
                            'thoi_gian_bat_dau' => 'required | unique:ca_hoc,thoi_gian_bat_dau,'.$id,
                            'thoi_gian_ket_thuc' => 'required | after:thoi_gian_bat_dau| unique:ca_hoc,thoi_gian_ket_thuc, '.$id,
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
