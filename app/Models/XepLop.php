<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class XepLop extends Model
{
    use HasFactory;
    protected $table = 'xep_lop';
    protected $guarded = [];

    public function index($params, $pagination = true,  $perpage)
    {
        // hàm có 3 tham số truyền vào lần lượt là mảng keyword , có phần trang hay không , số bản ghi trong 1 trang
        if ($pagination) {
            // nếu phần trang
            $query = DB::table($this->table)
                ->join('lop', $this->table . '.id_lop', '=', 'lop.id')
                // ->join('ca_hoc',  'lop.id_ca_hoc', '=', 'ca_hoc.id')
                ->join('phong_hoc', $this->table . '.id_phong_hoc', '=', 'phong_hoc.id')
                // ->join('users', $this->table . '.id_user', '=', 'users.id')
                ->join('giang_vien', 'giang_vien.id_user', '=',     'lop.id_giang_Vien')
                ->join('khoa_hoc','lop.id_khoa_hoc','=','khoa_hoc.id')
                ->select($this->table . '.*', $this->table . '.id  as  id_xep_lop', 'lop.*','khoa_hoc.*', 'giang_vien.*', 'phong_hoc.*')
                ->where($this->table . '.delete_at', '=', 1)
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.id_lop', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->paginate($perpage)->withQueryString();
        } else {
            // nếu không phần trang
            $query = DB::table($this->table)
                ->join('lop', $this->table . '.id_lop', '=', 'lop.id')
                // ->join('ca_hoc',  'lop.id_ca_hoc', '=', 'ca_hoc.id')
                ->join('phong_hoc', $this->table . '.id_phong_hoc', '=', 'phong_hoc.id')
                // ->join('users', $this->table . '.id_user', '=', 'users.id')
                ->join('giang_vien', 'giang_vien.id', '=',     $this->table . '.id_user')
                ->select($this->table . '.*', $this->table . '.id  as  id_xep_lop', 'lop.*',  'users.*', 'giang_vien.*', 'phong_hoc.*')
                ->where($this->table . '.delete_at', '=', 1)
                ->orderByDesc($this->table . '.id');
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
}
