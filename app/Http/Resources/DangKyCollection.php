<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\LopCollection;
class DangKyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'ngay_dang_ky'=>$data->ngay_dang_ky,
                    'id_thanh_toan'=>$data->id_thanh_toan,
                    'gia'=>$data->gia,
                    'id_lop'=>$data->lop,
                    'id_user'=>$data->id_user,
                    'trang_thai'=>$data->trang_thai,
                    'delete_at'=>$data->delete_at,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at,
                    //tự đưa vào
                    'links' => [
                        'self' => 'link-value',
                    ],
                ];
            })
        ];
    }
    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
