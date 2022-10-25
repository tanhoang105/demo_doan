<?php

namespace App\Http\Resources;

use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use Illuminate\Http\Resources\Json\ResourceCollection;

class KhoaHocCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
//    public $preserveKeys = true;
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'ten_khoa_hoc'=>$data->ten_khoa_hoc,
                    'id_danh_muc'=>$data->id_danh_muc,
                    'gia_khoa_hoc'=>$data->gia_khoa_hoc,
                    'mo_ta'=>$data->mo_ta,
                    'hinh_anh'=>$data->hinh_anh,
                    'trang_thai'=>$data->trang_thai,
                    'ten_danh_muc'=>$data->ten_danh_muc,
                    'delete_at'=>$data->delete_at,
                ];
            })
        ];
    }
}
