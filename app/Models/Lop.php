<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Lop extends Model
{
    use HasFactory;
    protected $table = 'lop';
    protected $guarded = [];

    public function khoaHoc()
    {
        return $this->hasMany(KhoaHoc::class);
    }

    public function listGiangVien($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query  = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                // ->where($this->table . '.delete_at', '=', 1 )
                ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
                ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*')
                ->orderByDesc($this->table . '.id');


            // hiển thị những lớp đã có giảng viên
            if (!empty($params['checkgv']) && $params['checkgv'] ==  1) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.id_giang_vien');
                });
            }
            // hiển thị những lớp chưa có giảng viên 
            if (!empty($params['checkgv']) && $params['checkgv'] ==  2) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhereNotNull($this->table . '.id_giang_vien');
                });
            }
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_lop', 'like', '%' . $params['keyword']  . '%');
                    // $q->orWhere('khoa_hoc.ten_khoa_hoc', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->paginate($perpage)->withQueryString();
            // dd($list);
        } else {

            // khi lấy ra list lớp học để insert vào các bảng khác thì không cần join bảng
            $query  = DB::table($this->table)

                ->where($this->table . '.delete_at', '=', 1)
                ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
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




    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            // dd($params);
            $query  = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
                ->join('giang_vien', $this->table  . '.id_giang_vien', 'giang_vien.id_user')
                ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*', 'giang_vien.*')
                ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*')
                ->orderByDesc($this->table . '.id');



            if (!empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_lop', 'like', '%' . $params['loc']['keyword']  . '%');
                    $q->orWhere($this->table . '.so_luong', 'like', '%' . $params['loc']['keyword']  . '%');
                    $q->orWhere('khoa_hoc.ten_khoa_hoc', 'like', '%' . $params['loc']['keyword']  . '%');
                    $q->orWhere('giang_vien.ten_giang_vien', 'like', '%' . $params['loc']['keyword']  . '%');
                });
            }

            if (empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    // dd($params);
                    // if (!empty($params['khoa_hoc'])) {
                    if (!empty($params['loc']['khoa_hoc'])) {

                        $q->Where($this->table . '.id_khoa_hoc',  $params['loc']['khoa_hoc']  );
                    }
                    if (!empty($params['loc']['giang_vien'])) {

                        $q->Where($this->table . '.id_giang_vien',  $params['loc']['giang_vien']  );
                    }
                    if (!empty($params['loc']['ca_thu'])) {

                        $q->Where($this->table . '.ca_thu_id',  $params['loc']['ca_thu']  );
                    }
                    if (!empty($params['loc']['ngay_bat_dau'])) {

                        $q->Where($this->table . '.ngay_bat_dau',  $params['loc']['ngay_bat_dau']  );
                    }
                    
                   
                   
                   
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
    public function remove($id = null, $id_khoahoc = null)
    {
        if ($id != null) {


            $query = DB::table($this->table)->where('id', '=', $id);

            // dd($query);
            $data = [
                'delete_at' => 0
            ];
            $query = $query->update($data);

            // return $query;
        } elseif ($id == null && $id_khoahoc != null) {
            $query = DB::table($this->table)->where('id_khoa_hoc', '=', $id_khoahoc);

            // dd($query);
            $data = [
                'delete_at' => 0
            ];
            $query = $query->update($data);

            // return $query;
        } else {
            Session::flash('error', 'Lỗi xóa bản ghi');
            return back();
        }
        return $query;
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
    public function LoadLopofKhoaHoc($id)
    {
        $lop = Lop::select('lop.*', 'giang_vien.ten_giang_vien')
            ->where('lop.id_khoa_hoc', '=', $id)
            ->join('giang_vien', 'lop.id_giang_vien', '=', 'giang_vien.id')
            ->where('lop.id_giang_vien', '<>', 'null')
            ->get();
        return $lop;
    }


    public function remoAll($params = null, $id_khoahoc = null)
    {
        // dd($params['id']['id']);

        if ($params != null) {

            $data = [
                'delete_at' => 0
            ];
            $query = DB::table($this->table)
                ->whereIn('id', $params['cols']['id']);
            // dd($query);
            $query = $query->update($data);
        } elseif ($params == null && $id_khoahoc != null) {
            $data = [
                'delete_at' => 0
            ];
            $query = DB::table($this->table)
                ->whereIn('id_khoa_hoc', $id_khoahoc['cols']['id']);
            // dd($query);
            $query = $query->update($data);
        } else {
            Session::flash('error', 'Lỗi xóa ');
            return back();
        }
    }
}
