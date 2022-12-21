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
        $giang_vien = GiangVien::find($id);
        // dd($giang_vien->id_user);
        $khoa_hoc = Lop::join('khoa_hoc', 'lop.id_khoa_hoc', '=', 'khoa_hoc.id')
            ->where('lop.id_giang_vien', '=', $giang_vien->id_user)
            ->select('khoa_hoc.*')
            ->get();
        // dd($khoa_hoc);
        return view('client.giang-vien.chi-tiet-giang-vien', compact('giang_vien', 'khoa_hoc'));
    }
}
