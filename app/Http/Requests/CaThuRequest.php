<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaThuRequest extends FormRequest
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
                    case 'store':
                        $rules = [
                            'ca_id' => 'required',
                            'thu_hoc_id' => 'required',
                        ];
                        break;

                    case 'update':
                        $rules = [
                            'ca_id' => 'required',
                            'thu_hoc_id' => 'required',
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
            'ca_id.required' => 'Bắt buộc phải chọn ca học',
            'thu_hoc_id.required' => 'Bắt buộc phải chọn ngày học',
        ];
    }
}
