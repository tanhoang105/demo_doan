<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KhoaHoc extends Model
{
    use HasFactory;
    protected $table = 'khoa_hoc'; // định nghĩa tên bảng

    protected $guarded = []; // định nghĩa các trường dữ liệu muốn làm việc

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class);
    }
    // định nghĩa các hàm muốn thao tác với cơ sở dữ liệu

    // hàm lấy tất cả các bản ghi
    public function index($params, $pagination = true,  $perpage)
    {

        // hàm có 3 tham số truyền vào lần lượt là mảng keyword , có phần trang hay không , số bản ghi trong 1 trang
        if ($pagination) {
            // nếu phần trang
            $query = DB::table($this->table)
                ->join('danh_muc', $this->table . '.id_danh_muc', '=', 'danh_muc.id')

                ->select('danh_muc.*', $this->table . '.*')
                ->where($this->table . '.delete_at', '=', 1)
                ->orderByDesc($this->table . '.id', $this->table . '.*');

            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_khoa_hoc', 'like', '%' . $params['keyword']  . '%');
                });
            }
            if (!empty($params)) {
                $query =  $query->where(function ($q) use ($params) {
                    // dd($params);
                    // if (!empty($params['khoa_hoc'])) {
                        $q->Where($this->table . '.id_danh_muc', 'like', '%' . $params['danh_muc']  . '%');      

                        if( $params['gia_khoa_hoc'] == 1 ) {
                            $q->Where( 'gia_khoa_hoc', '<', '200000');
                        } elseif( $params['gia_khoa_hoc'] == 2 ) {
                            $q->Where( 'gia_khoa_hoc', '>', '200000',);
                            $q->Where( 'gia_khoa_hoc', '<', '500000',);
                        } elseif( $params['gia_khoa_hoc'] == 3 ) {
                            $q->Where( 'gia_khoa_hoc', '>', '500000');
                        }
                        
                    //     if( $params['luot_xem'] == 1 ) {
                    // $q->orderByDesc($this->table . '.luot_xem');
                    // // dd(1);
                    //         } 

                });
                
            } 
            $list = $query->paginate($perpage)->withQueryString();
        } else {
            // nếu không phần trang
            $query = DB::table($this->table)
                ->join('danh_muc', $this->table . '.id_danh_muc', '=', 'danh_muc.id')

                ->select('danh_muc.*', $this->table . '.*')
                ->where($this->table . '.delete_at', '=', 1)
                ->orderByDesc($this->table . '.id', $this->table . '.*');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_khoa_hoc', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->get();
        }
        return $list;
    }

    // hiển thị ra chi tiết 1 bản ghi
    public function show($id)
    {
        if (!empty($id)) {
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
    public function remove($id = null, $id_danhmuc = null)

    {
        $data = [
            'delete_at' => 0
        ];
        if (!empty($id)) {

            $query = DB::table($this->table)->where('id', '=', $id);
        } elseif ($id == null && $id_danhmuc != null) {
            $query = DB::table($this->table)->where('id_danh_muc', '=', $id_danhmuc);
        }
        $query = $query->update($data);
        return $query;
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

    public function scopeSearch($query)
    {
        if ($key = request()->search) {
            $query = $query->where('ten_khoa_hoc', 'like', '%' . $key . '%');
        }
        // dd($query);

    }


    public function remoAll($params = null, $id_danhmuc = null)
    {
        // dd($params['id']['id']);
        $data = [
            'delete_at' => 0
        ];
        if ($params != null) {

            $query = DB::table($this->table)
                ->whereIn('id', $params['cols']['id']);
        } elseif ($params ==  null && $id_danhmuc != null) {
            $query = DB::table($this->table)
                ->whereIn('id_danh_muc', $id_danhmuc['cols']['id']);
        }
        $query = $query->update($data);

        return $query;
    }
}

