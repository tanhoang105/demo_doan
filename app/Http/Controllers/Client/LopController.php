<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\DoiLopKhoa;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LopController extends Controller
{
    protected $v;
    protected $xeplop;

    public function __construct()
    {
        $this->v = [];
        $this->xeplop = new XepLop();
    }
    public function index(Request $request)
    {
        $list = DangKy::join('lop', 'dang_ky.id_lop', '=', 'lop.id')
        ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
        ->join('giang_vien', 'giang_vien.id_user', '=', 'lop.id_giang_vien')
        ->join('ca_thu', 'ca_thu.id', '=', 'lop.ca_thu_id')
        ->where('dang_ky.id_user', '=', Auth::user()->id)
        ->select('dang_ky.*', 'khoa_hoc.ten_khoa_hoc', 'giang_vien.ten_giang_vien', 'ca_thu.ca_id','lop.ten_lop', 'lop.ngay_bat_dau', 'lop.so_luong', 'lop.id as lop_id', 'khoa_hoc.id as khoa_hoc_id')
        ->get();
    //    dd($list);
        $list_lop_moi = XepLop::join('lop', 'xep_lop.id_lop', '=', 'lop.id')
            ->where('lop.so_luong', '<', 40)
            ->select('xep_lop.*', 'lop.*')
            ->get();
        // dd($list_lop_moi);
        return view('client.lop.lop', compact('list', 'list_lop_moi'));
    }
    public function form_doi_lop($id, Request $request)
    {
        $xep_lop = XepLop::find($request->xeplop_id);
        $lop_cu = Lop::find($id);
        $lop_moi = Lop::where('lop.id_khoa_hoc', '=', $request->khoahoc_id)
            ->whereNotIn('id', [$id])
            ->where('lop.so_luong', '>', 0)
            ->where('lop.ngay_bat_dau', '>=', date(now()))
            ->select('lop.*')->get();
        // dd($lop_moi);
        return view('client.lop.form_doi_lop', compact('lop_cu', 'lop_moi', 'xep_lop'));
    }
    public function doi_lop(Request $request)
    {
        // dd($request->all());
        $doi_lop = new DoiLopKhoa();
        $doi_lop->fill($request->all());
        $doi_lop->save();
        // xep lop thay doi id lop
        // $xep_lop = XepLop::find($request->id_xeplop);
        // $xep_lop->id_lop = $request->id_lopmoi;
        // // lop cu thay doi so luong
        // $lop_cu = Lop::find($request->id_lopcu);
        // $lop_cu->so_luong = $lop_cu->so_luong + 1;
        // // lop moi thay doi so luong
        // $lop_moi = Lop::find($request->id_lopmoi);
        // $lop_moi->so_luong = $lop_moi->so_luong - 1;
        // // dang ky thay doi id lop
        // $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
        //     ->where('id_user', '=', Auth::user()->id)
        //     ->update(['id_lop' => $lop_moi->id]);

        // // luu du lieu
        // $xep_lop->save();
        // $lop_cu->save();
        // $lop_moi->save();
        session()->flash('success', 'Bạn đã gửi yêu cầu thay đổi lớp thành công!');
        return redirect()->route('client_lop');
    }
}
