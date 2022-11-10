<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LichHocController extends Controller
{
    public function index() {
        $lichhoc = XepLop::join('lop','xep_lop.id_lop','=','lop.id')
        ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
        ->join('giang_vien','giang_vien.id','=','lop.id_giang_vien')
        ->join('ca_hoc','ca_hoc.id','=','lop.id_ca_hoc')
        ->join('phong_hoc','xep_lop.id_phong_hoc','=','phong_hoc.id')
        ->where('xep_lop.id_user','=',Auth::user()->id)
        ->select('xep_lop.*','khoa_hoc.ten_khoa_hoc','giang_vien.ten_giang_vien','ca_hoc.ca_hoc','ca_hoc.thoi_gian','phong_hoc.ten_phong','lop.ten_lop')
        ->get();
        // dd($lichhoc);
         return view('client.lich-hoc.lich-hoc',compact('lichhoc'));
     }
}
