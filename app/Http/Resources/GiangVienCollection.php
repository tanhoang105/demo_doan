<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GiangVienCollection extends ResourceCollection
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
                    'id_user'=>$data->id_user,
                    'ten_giang_vien'=>$data->ten_giang_vien,
                    'dia_chi'=>$data->dia_chi,
                    'email'=>$data->email,
                    'sdt'=>$data->sdt,
                    'gioi_tinh'=>$data->gioi_tinh,
                    'mo_ta'=>$data->mo_ta,
                    'delete_at'=>$data->delete_at,
                    'trang_thai'=>$data->trang_thai,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at,
                ];
            })
        ];
    }
}
