<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KhuyenMaiCollection extends ResourceCollection
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
                    'ma_khuyen_mai'=>$data->ma_khuyen_mai,
                    'loai_khuyen_mai'=>$data->loai_khuyen_mai,
                    'mo_ta'=>$data->mo_ta,
                    'giam_gia'=>$data->giam_gia,
                    'ngay_bat_dau'=>$data->ngay_bat_dau,
                    'ngay_ket_thuc'=>$data->ngay_ket_thuc,
                    'trang_thai'=>$data->trang_thai,
                    'delete_at'=>$data->delete_at,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at,
                    //tự đưa vào
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
