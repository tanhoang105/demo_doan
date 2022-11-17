<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\GhiNo;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\length;

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
        // dd($lop);
        $khoahoclienquan = KhoaHoc::select('khoa_hoc.*', 'danh_muc.ten_danh_muc')->where('khoa_hoc.id_danh_muc', '=', $detail->id_danh_muc)
            ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
            ->whereNotIn('khoa_hoc.id' , [$id])
            ->skip(0)->take(4)->get();
        return view('client.khoa-hoc.chi-tiet-khoa-hoc', compact('detail', 'giang_vien', 'lop', 'danhmuc', 'khoahoclienquan'));
    }
    public function locKhoaHoc(Request $request)
    {
//        dd($request->all());
        $filter = [];
        $sort = [];
        $query = DB::table('khoa_hoc')
            ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
            ->select('danh_muc.*', 'khoa_hoc.*')
            ->where('khoa_hoc.delete_at', '=', 1);

        if (!empty($request->search)) {
            $filter[] = ['ten_khoa_hoc', 'like', '%' . $request->search . '%'];
        }
        if (!empty($request->filterKh)) {
            if ($request->filterKh == 'new') {
//                $sort[]=['id','desc'];
                $query = $query->orderBy('khoa_hoc.id', 'desc');
            } else {
//                $sort[]=['gia_khoa_hoc',$request->filterKh];
                $query = $query->orderBy('gia_khoa_hoc', $request->filterKh);
            }

        }
        if (!empty($filter)) {
            $query = $query->where($filter);
        }
        $listKh = $query->get();
        $renderHtml = view('client.render-kh', compact('listKh'))->render();
        return response()->json(array('success' => true, 'data' => $renderHtml));
    }
    public function khoa_hoc()

    {
        //
        $khoa_hoc_cu = KhoaHoc::join('lop', 'lop.id_khoa_hoc', '=', 'khoa_hoc.id')
            ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
            ->join('danh_muc', 'danh_muc.id', '=', 'khoa_hoc.id_danh_muc')
            ->where('xep_lop.id_user', '=', Auth::user()->id)
            ->select('khoa_hoc.*', 'danh_muc.ten_danh_muc', 'lop.id as lop_id', 'xep_lop.id as xep_lop_id')
            ->get();
        // dd($khoa_hoc_cu);
        return view('client.khoa-hoc.khoa_hoc_dang_ki.index', compact('khoa_hoc_cu'));
    }
    public function get_khoa_hoc(Request $request)
    {
        // dd($request->all());
        $lopcu_id = $request->lopcu_id;
        $xeplop_id = $request->xeplop_id;
        //
        $list = KhoaHoc::join('danh_muc', 'danh_muc.id', '=', 'khoa_hoc.id_danh_muc')
            ->select('khoa_hoc.*', 'danh_muc.ten_danh_muc')
            ->get();
        return view('client.khoa-hoc.khoa_hoc_dang_ki.khoa_hoc_dang_ki', compact('list', 'xeplop_id', 'lopcu_id'));
    }
    public function get_lop($id, Request $request)
    {
        // dd($request->all());
        $lopcu_id = $request->lopcu_id;
        $xeplop_id = $request->xeplop_id;
        $list = Lop::where('lop.id_khoa_hoc', '=', $id)
            ->join('giang_vien', 'giang_vien.id', '=', 'lop.id_giang_vien')
            ->join('ca_hoc', 'ca_hoc.id', '=', 'lop.id_ca_hoc')
            ->select('lop.*', 'giang_vien.ten_giang_vien', 'ca_hoc.ca_hoc')
            ->get();
        // dd($list);
        return view('client.khoa-hoc.khoa_hoc_dang_ki.lop_dang_ki', compact('list', 'xeplop_id', 'lopcu_id'));
    }
    public function doi_khoa_hoc(Request $request)
    {
        // dd($request->all());
        $xep_lop = XepLop::find($request->xeplop_id);
        $xep_lop->id_lop = $request->lopmoi_id;
        // lop cu thay doi so luong
        $lop_cu = Lop::find($request->lopcu_id);
        $lop_cu->so_luong = $lop_cu->so_luong + 1;
        // lop moi thay doi so luong
        $lop_moi = Lop::find($request->lopmoi_id);
        $lop_moi->so_luong = $lop_moi->so_luong - 1;
        // dang ky thay doi id lop
        $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
            ->where('id_user', '=', Auth::user()->id)
            ->update(['id_lop' => $lop_moi->id]);


        // ghi no
        $khoahoc_cu = KhoaHoc::find($lop_cu->id_khoa_hoc);
        $khoahoc_moi = KhoaHoc::find($lop_moi->id_khoa_hoc);
        //
        $kk = GhiNo::where('user_id', '=', Auth::user()->id)->first()->get();

        $tien = $khoahoc_moi->gia_khoa_hoc - $khoahoc_cu->gia_khoa_hoc;
        foreach ($kk as  $value) {
            if ($tien > 0) {
                $ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['tien_no' => $value->tien_no + $tien]);
                $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['trang_thai' => 1]); //hoc vien no

            } elseif ($tien < 0) {
                $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['tien_no' => $value->tien_no + $tien]);
                    //
                $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['trang_thai' => 1]); //trung tam  no
            } else {
                $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['tien_no' => $value->tien_no + $tien]);
                    //
                $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                    ->update(['trang_thai' => 0]); //het no
            }
        }
        // luu du lieu
        $xep_lop->save();
        $lop_cu->save();
        $lop_moi->save();
        return redirect()->route('khoa_hoc_dang_ki');
    }
}
