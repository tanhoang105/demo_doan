<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DangKyRequest extends FormRequest
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
                                    'name' => 'required',
                                    'email' => 'required | email | unique:users',
                                    'sdt' => 'required|min:11|numeric',
                                    'dia_chi' => 'required | min:6',
                                    'id_khoa_hoc' => 'numeric|min:1',
                                    'id_lop' => 'numeric|min:1',
                                ];
                            break;

                            // nếu là method chỉnh sửa bản ghi
                            case 'update':
                                $id = $request->id_user;
                                $rules = [
                                    'name' => 'required',
                                    'email' => 'required | email | unique:users,email,'.$id,
                                    'sdt' => 'required|min:11|numeric',
                                    'dia_chi' => 'required | min:6',
                                ];
                            break;   
                            case 'postDangKy':
                                $rules = [
                                    'name' => 'required',
                                    'email' => 'required | email',
                                    'sdt' => 'required|min:11|numeric',
                                    'dia_chi' => 'required | min:6',
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
            'name.required' => 'Họ tên bắt buộc nhập',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Sai định dạng Email',
            'email.unique' => 'Email đã tồn tại',
            'sdt.required' => 'Số điện thoại bắt buộc nhập',
            'min'=> ':attribute lớn hơn 6 ký tự',
            'id_khoa_hoc' => 'Bắt buộc phải chọn khóa học',
            'id_lop'=>'Bắt buộc phải chọn lớp',
            'dia_chi.required' => 'Địa chỉ bắt buộc nhập',
        ];
    }
}