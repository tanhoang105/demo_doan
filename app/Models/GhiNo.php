<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GhiNo extends Model
{
    use HasFactory;
    protected $table = 'ghi_no';
    protected $guarded = [];

    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            // dd($params);
            $query = GhiNo::join('users', 'users.id', '=', 'ghi_no.user_id')
            ->select('ghi_no.*', 'users.name','users.email');

            // $query  = DB::table($this->table)
            //     ->where($this->table . '.delete_at', '=', 1)
            //     ->join('khoa_hoc', $this->table  . '.id_khoa_hoc', 'khoa_hoc.id')
            //     ->join('giang_vien', $this->table  . '.id_giang_vien', 'giang_vien.id_user')
            //     ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*', 'giang_vien.*')
            //     ->select($this->table . '.*', $this->table . '.id as id_lop',  'khoa_hoc.*')
            //     ->orderByDesc($this->table . '.id');



            if (!empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere(  'users.name', 'like', '%' . $params['loc']['keyword']  . '%');
                    $q->orWhere(  'users.email', 'like', '%' . $params['loc']['keyword']  . '%');
                   
                });
            }

            if (empty($params['loc']['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    // dd($params);
                    // if (!empty($params['khoa_hoc'])) {
                    if (!empty($params['loc']['khoa_hoc'])) {

                        $q->Where($this->table . '.id_khoa_hoc',  $params['loc']['khoa_hoc']);
                    }
                    if (!empty($params['loc']['giang_vien'])) {

                        $q->Where($this->table . '.id_giang_vien',  $params['loc']['giang_vien']);
                    }
                    if (!empty($params['loc']['ca_thu'])) {

                        $q->Where($this->table . '.ca_thu_id',  $params['loc']['ca_thu']);
                    }
                    if (!empty($params['loc']['ngay_bat_dau'])) {

                        $q->Where($this->table . '.ngay_bat_dau',  $params['loc']['ngay_bat_dau']);
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
}
