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
    function index(Request $request) {
        $hocvien = HocVien::count('id');
        $dangky = DangKy::count('id');
        $khoahoc = KhoaHoc::count('id');
        $doanhthutong = DangKy::where('dang_ky.delete_at',1)->sum('gia');
        $doanhthudathu = DB::table('dang_ky')
        ->join('thanh_toan' ,'thanh_toan.id','=','dang_ky.id_thanh_toan')
        ->where('thanh_toan.trang_thai',2)
        ->sum('dang_ky.gia');
        // dd($doanhthudathu);
        // $month = Carbon::now();
        $soHocVienThang = DangKy::whereMonth('ngay_dang_ky' , Carbon::today()->month)
        ->groupBy('dang_ky.id_user')->get();
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

        // tung 
        $list = DB::table('khoa_hoc')
        ->leftJoin('lop','lop.id_khoa_hoc','=','khoa_hoc.id')
        ->leftJoin('dang_ky','dang_ky.id_lop','=','lop.id')
        ->leftJoin('hoc_vien','hoc_vien.user_id','=','dang_ky.id_user');
        // ->rightJoin('thanh_toan','thanh_toan.id','=','dang_ky.id_thanh_toan');

        $listTK = $list->groupBy('khoa_hoc.id')
        // ->groupBy('hoc_vien.id')
        ->select('khoa_hoc.ten_khoa_hoc','khoa_hoc.id as id_khoa_hoc','lop.id as id_lop','dang_ky.id_lop as id_lop_dk'
        ,DB::raw('SUM(dang_ky.gia) as doanh_thu'))
        // // ->orderBy('dang_ky.id_user')
        ->get();

        $filter = [];
        if(!empty($request->date_start) && empty($request->date_end)) {
            $dateStart =$request->date_start;
            $filter[] = ['ngay_dang_ky','>=',$dateStart];
        }else if(empty($request->date_start) && !empty($request->date_end)) {
            $dateEnd = $request->date_end;
            $filter[] = ['ngay_dang_ky','<=',$dateEnd];
        }else if(!empty($request->date_start) && !empty($request->date_end)) {
            $dateEnd = $request->date_end;
            $dateStart = $request->date_start;
            $filter[] = ['ngay_dang_ky','>=',$dateStart];
            $filter[] = ['ngay_dang_ky','<=',$dateEnd];
        }

        if(!empty($filter)) {
            $listFilter = $list->where($filter)->groupBy('khoa_hoc.id')
            ->select('khoa_hoc.ten_khoa_hoc','khoa_hoc.id as id_khoa_hoc','lop.id as id_lop','dang_ky.id_lop as id_lop_dk'
            ,DB::raw('SUM(dang_ky.gia) as doanh_thu'))
            ->get();
            foreach($listTK as $item) {
                if(!in_array($item,$listFilter->toArray())) {
                    $item->doanh_thu = 0;
                }
                foreach($listFilter as $itemFilter) {
                    if($item->id_khoa_hoc == $itemFilter->id_khoa_hoc) {
                        $item->doanh_thu = number_format($itemFilter->doanh_thu);
                    }
                }
            }
            return response()->json([
                'success' => true,
                'data' => $listTK
            ]);
        }
        
        return view('admin.thongke.thong-ke', compact('hocvien','listTK','dangky', 'khoahoc', 'doanhthutong','doanhthudathu', 'donutChart', 'areaChart','soHocVienThang'));
    }

    // public function 

}
