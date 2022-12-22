<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KhuyenMai extends Model
{
    use HasFactory;
    protected $table = 'khuyen_mai'; // định nghĩa tên bảng

    protected $guarded = []; // định nghĩa các trường dữ liệu muốn làm việc

    // định nghĩa các hàm muốn thao tác với cơ sở dữ liệu

    // hàm lấy tất cả các bản ghi
    public function index($params, $pagination = true,  $perpage)
    {

        // hàm có 3 tham số truyền vào lần lượt là mảng keyword , có phần trang hay không , số bản ghi trong 1 trang
        if ($pagination) {
            // nếu phần trang
            $query = DB::table($this->table)
                ->select($this->table . '.*')
                ->where('delete_at', '=', 1)
                ->orderByDesc($this->table . '.id');
            if (!empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ma_khuyen_mai', 'like', '%' . $params['loc']['keyword']  . '%');
                    $q->orWhere($this->table . '.ma_khuyen_mai', 'like', '%' . $params['loc']['keyword']  . '%');
                });
            }

            if (empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    // dd($params);
                    // if (!empty($params['khoa_hoc'])) {
                    if (!empty($params['loc']['loai_khuyen_mai'])) {

                        $q->Where($this->table . '.loai_khuyen_mai',  $params['loc']['loai_khuyen_mai']);
                    }
                    if (!empty($params['loc']['loai_giam_gia'])) {

                        $q->Where($this->table . '.loai_giam_gia',  $params['loc']['loai_giam_gia']);
                    }
                   
                    if (!empty($params['loc']['ngay_bat_dau'])) {

                        $q->Where($this->table . '.ngay_bat_dau',  $params['loc']['ngay_bat_dau']);
                    }
                    if (!empty($params['loc']['ngay_ket_thuc'])) {

                        $q->Where($this->table .  '.ngay_ket_thuc',  $params['loc']['ngay_ket_thuc']);
                    }
                });
            }


            $list = $query->paginate($perpage)->withQueryString();
        } else {
            // nếu không phần trang
            $query = DB::table($this->table)
                ->select($this->table . '.*')
                ->where('delete_at', '=', 1)
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ma_khuyen_mai', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->get();
        }
        return $list;
    }

    // hiển thị ra chi tiết 1 bản ghi
    public function show($id)
    {
        if (($id)) {
            $query = DB::table($this->table)
                ->where('id', '=', $id)
                ->first();
            return $query;
        }
    }


    // hàm thêm bản ghi
    public function create($params)
    {
        $data  = array_merge($params['cols'], [
            // 'created_at' => date('Y-m-d H:i:s'),
            'delete_at' => 1,
        ]);

        $query = DB::table($this->table)->insertGetId($data);
        return $query;
    }

    // hàm xóa bản ghi theo id
    public function remove($id)
    {
        if (!empty($id)) {
            $query = DB::table($this->table)
                    ->where('id', '=', $id);
            $data = [
                'delete_at' => 0
            ];
            $query = $query->update($data);
            return $query;
        }
    }


    // hàm update bản ghi
    public function saveupdate($params)
    {
        $data = array_merge($params['cols'], [
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        $query =  DB::table($this->table)
            ->where('id', '=', $params['cols']['id'])
            ->update($data);
        return $query;
    }

    public function remoAll($params){
        // dd($params['id']['id']);
        $data = [
            'delete_at' => 0
        ];
        $query = DB::table($this->table) 
                ->whereIn('id', $params['cols']['id']);
        // dd($query);
        $query = $query->update($data);
        return $query;

    }
}
