<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DangKy extends Model
{
    use HasFactory;
    protected $table="dang_ky";
    public function saveNew($params){
        // dd($data);
        $res=DB::table('dang_ky')
            ->insertGetId($params);
        return $res;
    // protected $table = "dang_ky";
    }

    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query  = DB::table($this->table)
                ->where($this->table  .'.delete_at', '=', 1)
                ->join('lop' , 'lop.id' , '=' , $this->table . '.id_lop')
                ->join('khoa_hoc' , 'khoa_hoc.id' , '=' , 'lop.id_khoa_hoc')
                ->join('hoc_vien' , 'hoc_vien.user_id' , '=' , $this->table . '.id_user')
                ->join('thanh_toan' , 'thanh_toan.id' , '=' , $this->table . '.id_thanh_toan')
                ->select( 'hoc_vien.*','thanh_toan.trang_thai as trang_thai_thanh_toan','khoa_hoc.*', 'lop.*' , $this->table . '.*')
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.id_ngay_dang_ky', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->paginate($perpage)->withQueryString();
        } else {
            $query  = DB::table($this->table)
                ->where('delete_at', '=', 1)
                ->select($this->table . '.*')
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ca_hoc', 'like', '%' . $params['keyword']  . '%');
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
    //
    public function listLopofKhoaHoc($id_khoa_hoc){
        $query=DB::table('lop')
            ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
            ->select('lop.*','khoa_hoc.ten_khoa_hoc','khoa_hoc.gia_khoa_hoc')
            ->where('lop.id_giang_vien','>',0)
            ->where('lop.id_khoa_hoc','=',$id_khoa_hoc);
        $list=$query->get();
        return $list;
    }
    //hiển thị chi tiết đăng ký
    // đăng ký client
    public function listDangky($id){
        $query=DB::table('lop')
            ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
            ->join('giang_vien','giang_vien.id_user','=','lop.id_giang_vien')
            ->join('ca_thu','ca_thu.id','=','lop.ca_thu_id')
            // ->join('ca_thu','ca_thu.thu_hoc_id','=','thu_hoc.id')
            ->join('ca_hoc','ca_hoc.id','=','ca_thu.ca_id')
            ->join('thu_hoc','thu_hoc.id','=','ca_thu.thu_hoc_id')
            ->select('lop.*','khoa_hoc.ten_khoa_hoc','khoa_hoc.gia_khoa_hoc','ten_giang_vien','ca_hoc','thoi_gian_bat_dau','thoi_gian_ket_thuc','thu_hoc.ten_thu','ca_thu.thu_hoc_id','ca_thu.ca_id')
            ->where('lop.id','=',$id);
        $list=$query->first();
        return $list;
    }

    public function loadOne($id) {
        $query = DB::table('dang_ky')
                ->join('users','users.id','=','dang_ky.id_user')
                ->join('hoc_vien' , 'hoc_vien.user_id' , '=' ,  'dang_ky.id_user')
                ->join('lop','lop.id','=','dang_ky.id_lop')
                ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
                ->join('thanh_toan','thanh_toan.id','=','dang_ky.id_thanh_toan')
                ->select('dang_ky.id','dang_ky.id_user','dang_ky.id_thanh_toan','hoc_vien.sdt','dang_ky.gia as gia_khoa_hoc','hoc_vien.ten_hoc_vien as name','dang_ky.email','hoc_vien.dia_chi','ten_lop','ten_khoa_hoc','thanh_toan.trang_thai')
                ->where('dang_ky.id',$id)
                ->first();
        return $query;
        
    }
    // lấy thứ
    public function layThu($thu_hoc_id){
        $query =DB::table('thu_hoc')
        ->whereIn('id',$thu_hoc_id)
        ->get();
        return $query;
    }
    public function completeDangKy($code){
        $query=DB::table('dang_ky')
            ->join('users','users.id','=','dang_ky.id_user')
            ->join('lop','lop.id','=','dang_ky.id_lop')
            ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
            ->join('ca_thu','ca_thu.id','=','lop.ca_thu_id')
            // ->join('ca_thu','ca_thu.thu_hoc_id','=','thu_hoc.id')
            ->join('ca_hoc','ca_hoc.id','=','ca_thu.ca_id')
            ->join('thu_hoc','thu_hoc.id','=','ca_thu.thu_hoc_id')
            ->where('dang_ky.id',$code)
            ->select('dang_ky.id','users.sdt','lop.ngay_bat_dau','lop.ngay_ket_thuc','ngay_dang_ky','dang_ky.gia as gia_khoa_hoc','users.name','dang_ky.email','dia_chi','ten_lop','ten_khoa_hoc','ca_hoc','thoi_gian_bat_dau','thoi_gian_ket_thuc','thu_hoc.ten_thu','ca_thu.thu_hoc_id','ca_thu.ca_id')
            ->first();
        return $query;
    }

    // lịch sử đăng ký
    public function lichsu($id){
        $query=DB::table('dang_ky')
            ->join('users','users.id','=','dang_ky.id_user')
            ->join('hoc_vien','hoc_vien.user_id','=','users.id')
            ->join('lop','lop.id','=','dang_ky.id_lop')
            ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
            ->join('thanh_toan','thanh_toan.id','=','dang_ky.id_thanh_toan')
            ->where('id_user',$id)
            ->select('dang_ky.*','users.name','users.email','lop.ten_lop','khoa_hoc.ten_khoa_hoc','khoa_hoc.gia_khoa_hoc','users.dia_chi','users.sdt','thanh_toan.trang_thai as trang_thai_thanh_toan')
            ->get();
        $list=$query;
        return $list;
    }
}
