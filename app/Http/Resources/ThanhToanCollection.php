<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ThanhToanCollection extends ResourceCollection
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
                    'id_phuong_thuc_thanh_toan'=>$data->id_phuong_thuc_thanh_toan,
                    'ngay_thanh_toan'=>$data->ngay_thanh_toan,
                    'gia'=>$data->gia,
                    'mo_ta'=>$data->mo_ta,
                    'trang_thai'=>$data->trang_thai,
                    'delete_at'=>$data->delete_at,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at,
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
