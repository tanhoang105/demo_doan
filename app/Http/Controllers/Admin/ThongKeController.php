<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\HocVien;
use App\Models\KhoaHoc;
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

        $result = DB::select(DB::raw("SELECT COUNT(dang_ky.id_user) AS 'count_by_category',danh_muc.ten_danh_muc FROM `dang_ky` JOIN lop on lop.id = dang_ky.id_lop JOIN khoa_hoc on khoa_hoc.id = lop.id_khoa_hoc JOIN danh_muc ON danh_muc.id = khoa_hoc.id_danh_muc GROUP BY danh_muc.ten_danh_muc;"));
        $data = "";
        foreach($result as $key) {
            $data.="['".$key->ten_danh_muc."', ".$key->count_by_category."],"; 
        }
        $chartData = $data;
        // dd($chartData);    

        return view('admin.thongke.thong-ke', compact('hocvien', 'dangky', 'khoahoc','chartData'));
    }
}
