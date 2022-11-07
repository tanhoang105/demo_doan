<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhoaHocController extends Controller
{
    //
    public function index(Request $request)
    {
        $id_danhmuc = $request->id_danhmuc;
        $list = KhoaHoc::select('khoa_hoc.*')
            ->select('danh_muc.*', 'khoa_hoc.*')
            ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
            ->search()
            ->get();
        $danhmuc = DanhMuc::all();
        $loc_danhmuc = KhoaHoc::select('khoa_hoc.*', 'danh_muc.ten_danh_muc')->where('khoa_hoc.id_danh_muc', '=', $request->id_danh_muc)
            ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
            ->get();
        return view('client.khoa-hoc.khoa-hoc', compact('list', 'danhmuc', 'loc_danhmuc', 'id_danhmuc'));
    }
    public function chiTietKhoaHoc($id)
    {
        $giang_vien = GiangVien::all();
        $detail = KhoaHoc::find($id);
        $danhmuc = DanhMuc::select('danh_muc.*')->where('danh_muc.id', '=', $detail->id_danh_muc)->get();
        $lop = Lop::select('lop.*', 'giang_vien.ten_giang_vien')
            ->where('lop.id_khoa_hoc', '=', $id)
            // ->join('khoa_hoc','lop.id_khoa_hoc','=','khoa_hoc.id')
            ->join('giang_vien', 'lop.id_giang_vien', '=', 'giang_vien.id')
            ->get();
        $khoahoclienquan = KhoaHoc::select('khoa_hoc.*', 'danh_muc.ten_danh_muc')->where('khoa_hoc.id_danh_muc', '=', $detail->id_danh_muc)
            ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
            ->skip(0)->take(4)->get();
        return view('client.khoa-hoc.chi-tiet-khoa-hoc', compact('detail', 'giang_vien', 'lop', 'danhmuc', 'khoahoclienquan'));
    }
}
