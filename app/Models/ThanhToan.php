<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThanhToan extends Model
{
    use HasFactory;
    protected $table="thanh_toan";

    public function PhuongThucThanhToan(){
        return $this->belongsTo(ThanhToan::class);
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

    public function saveNew($params){
        // dd($data);
        $res=DB::table('thanh_toan')
            ->insertGetId($params);
        return $res;
    }
    // lấy thông tin đơn hàng
    public function loadOne($id){
        $result = DB::table('thanh_toan')
            ->join('dang_ky','dang_ky.id_thanh_toan','=','thanh_toan.id')
            ->where('dang_ky.id', $id)
            ->select('thanh_toan.*')
            ->get();
        return $result;
    }

    // cập nhập trạng thái đơn hàng
    public function updatePaid($id){
        $query = DB::table('thanh_toan')
            ->join('dang_ky','dang_ky.id_thanh_toan','=','thanh_toan.id')
            ->where('dang_ky.id', $id)
            ->update([
                'thanh_toan.trang_thai' => 2,
            ]);
        return $query;
    }
}
