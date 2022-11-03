<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lop extends Model
{
    use HasFactory;
    protected $table = 'lop';
    protected $guarded = [];
    public function khoaHoc()
    {
        return $this->hasMany(KhoaHoc::class);
    }
    public function index($params, $pagination = true, $perpage , $giaovien = null)
    {
        if ($pagination) {
            $query  = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
                ->join('giang_vien', $this->table  . '.id_giang_vien', 'giang_vien.id')
                ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*', 'giang_vien.*')
                ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*')
                ->orderByDesc($this->table . '.id');


            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_lop', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->paginate($perpage)->withQueryString();
            // dd($list);
        } else {

            // khi lấy ra list lớp học để insert vào các bảng khác thì không cần join bảng
            $query  = DB::table($this->table)

                ->where($this->table . '.delete_at', '=', 1)
                // ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
                // ->join('giang_vien', $this->table  . '.id_giang_vien', 'giang_vien.id')
                ->select($this->table . '.*')
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_lop', 'like', '%' . $params['keyword']  . '%');
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
    public function remove($id)
    {
        if (!empty($id)) {


            $query = DB::table($this->table)->where('id', '=', $id);
            // dd($query);
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
        $data = array_merge($params['cols'], []);
        $query =  DB::table($this->table)
            ->where('id', '=', $params['cols']['id'])
            ->update($data);
        return $query;
    }

    // hiển thị lớp
    public function LoadLopofKhoaHoc($id){
        $lop = Lop::select('lop.*','giang_vien.ten_giang_vien')
            ->where('lop.id_khoa_hoc', '=', $id)
            ->join('giang_vien','lop.id_giang_vien','=','giang_vien.id')
            ->where('lop.id_giang_vien','<>','null')
            ->get();
        return $lop;
    }
}
