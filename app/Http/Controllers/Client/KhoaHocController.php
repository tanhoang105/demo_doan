<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
        // $data = DB::table('giang_vien')->select('giang_vien.*')
        // ->skip(0)->take(3)
        // ->get();
        // dd($data);
        // $this->v['params'] = $request->all();
        // $khoahoc =  $this->khoahoc->index($this->v['params'], true, 3);
        // $this->v['list'] = $khoahoc;
        //    dd($khoahoc);
        $list = DB::table('khoa_hoc')->select('khoa_hoc.*')
        ->select('danh_muc.*','khoa_hoc.*')
       ->join('danh_muc','khoa_hoc.id_danh_muc','=','danh_muc.id')
        ->get();
        return view('client.khoa-hoc.khoa-hoc',compact('list'));
    }
    public function chiTietKhoaHoc($id)
    {
        $giang_vien = GiangVien::all();
        $detail = KhoaHoc::find($id);
        $lop = Lop::select('lop.*','giang_vien.ten_giang_vien')
            ->where('lop.id_khoa_hoc', '=', $id)
            // ->join('khoa_hoc','lop.id_khoa_hoc','=','khoa_hoc.id')
            ->join('giang_vien','lop.id_giang_vien','=','giang_vien.id')
            ->get();
        // dd($lop);
        // dd($detail);
        return view('client.khoa-hoc.chi-tiet-khoa-hoc', compact('detail', 'giang_vien','lop'));
    }
}
