<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class XepLopCollection extends ResourceCollection
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
                    'id_lop'=>$data->id_lop,
                    'id_user'=>$data->id_user,
                    'id_ca_hoc'=>$data->id_ca_hoc,
                    'id_phong_hoc'=>$data->id_phong_hoc,
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
