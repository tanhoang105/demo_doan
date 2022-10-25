<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LopCollection extends ResourceCollection
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
                    'id'=>$data->id,
                    'id_khoa_hoc'=>$data->id_khoa_hoc,
                    'ten_lop'=>$data->ten_lop,
                    'gia'=>$data->gia,
                    'so_luong'=>$data->so_luong,
                    'ngay_bat_dau'=>$data->ngay_bat_dau,
                    'ngay_ket_thuc'=>$data->ngay_ket_thuc,
                    'id_giang_vien'=>$data->id_giang_vien,
                    'delete_at'=>$data->delete_at,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at,
                ];
            })
        ];
    }
}
