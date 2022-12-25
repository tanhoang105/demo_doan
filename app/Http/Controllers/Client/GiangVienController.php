<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiangVienController extends Controller
{
    //
    public function index()
    {
        $giang_vien = DB::table('giang_vien')->select('giang_vien.*')
            ->get();
        // dd($data);
        return view('client.giang-vien.giang-vien', compact('giang_vien'));
    }
    public function chiTietGiangVien($id)
    {
        // dd($id);
        $giang_vien = GiangVien::find($id);
        // dd($giang_vien);
        $khoa_hoc = Lop::join('khoa_hoc', 'lop.id_khoa_hoc', '=', 'khoa_hoc.id')
        ->join('danh_muc','danh_muc.id','=','khoa_hoc.id_danh_muc')
 
            ->where('lop.id_giang_vien', '=', $giang_vien->id_user)
            ->groupBy('khoa_hoc.id')
            ->select('khoa_hoc.*','danh_muc.ten_danh_muc')
            ->paginate(4);
        // dd($khoa_hoc);
        return view('client.giang-vien.chi-tiet-giang-vien', compact('giang_vien', 'khoa_hoc'));
    }
}
