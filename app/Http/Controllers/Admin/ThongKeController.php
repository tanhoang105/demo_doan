<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\HocVien;
use App\Models\KhoaHoc;
use App\Models\ThanhToan;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    function index() {
        $hocvien = HocVien::count('id');
        $dangky = DangKy::count('id');
        $khoahoc = KhoaHoc::count('id');
        $doanhthu = ThanhToan::sum('gia');
        // dd($doanhthu);

        $result = DB::select(DB::raw("SELECT COUNT(dang_ky.id_user) AS 'count_by_category',danh_muc.ten_danh_muc FROM `dang_ky` JOIN lop on lop.id = dang_ky.id_lop JOIN khoa_hoc on khoa_hoc.id = lop.id_khoa_hoc JOIN danh_muc ON danh_muc.id = khoa_hoc.id_danh_muc GROUP BY danh_muc.ten_danh_muc;"));
        $data = "";
        foreach($result as $key) {
            $data.="['".$key->ten_danh_muc."', ".$key->count_by_category."],"; 
        }
        $donutChart = $data;
        // dd($donutChart);    

        $query = DB::select(DB::raw("SELECT ngay_thanh_toan, SUM(gia) AS 'doanh_thu' FROM thanh_toan GROUP BY ngay_thanh_toan ORDER BY ngay_thanh_toan ASC;"));
        $dt = "";
        foreach($query as $key) {
            $dt.="['".$key->ngay_thanh_toan."', ".$key->doanh_thu."],";
        }
        $areaChart = $dt;
        

        return view('admin.thongke.thong-ke', compact('hocvien', 'dangky', 'khoahoc', 'doanhthu', 'donutChart', 'areaChart'));
    }
}
