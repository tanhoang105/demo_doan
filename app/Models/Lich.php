<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lich extends Model
{
    use HasFactory;
    protected $table = 'lich_hoc';
    protected $guarded = [];

    public function index($params, $pagination = true,  $perpage)
    {

        // hàm có 3 tham số truyền vào lần lượt là mảng keyword , có phần trang hay không , số bản ghi trong 1 trang
        if ($pagination) {
            // nếu phần trang
            $query = DB::table($this->table)
            ->join('lop'  , $this->table . '.lop_id' , '=' , 'lop.id')
            ->join('xep_lop' , 'xep_lop.id_lop' , '='  , 'lop.id')
            ->join('thu_hoc' , $this->table . '.ma_thu' , '=' , 'thu_hoc.ma_thu')
            ->join('ca_hoc' , $this->table . '.ca_id' , '=' , 'ca_hoc.id'  )
            ->where($this->table . '.delete_at', '=', 1)
            ->select('xep_lop.*' , 'lop.*' , 'thu_hoc.*' , 'ca_hoc.*' , $this->table . '.*')
            ->orderByDesc($this->table . '.ngay_hoc');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere( 'lop.ten_lop', 'like', '%' . $params['keyword']  . '%');
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
        if ($id) {
            // dd($id);
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

    public function remoAll($params)
    {
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
