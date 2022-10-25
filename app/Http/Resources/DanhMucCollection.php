<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DanhMucCollection extends ResourceCollection
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
                    'ten_danh_muc'=>$data->ten_danh_muc,
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
