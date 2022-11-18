<?php

namespace App\Http\Controllers;

use App\Models\DangKy;
use App\Models\DoiLopKhoa;
use App\Models\GhiNo;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoiLopKhoaController extends Controller
{
    public function index()
    {
        $doi_lop_khoa = DoiLopKhoa::join('users', 'users.id', '=', 'id_user')
            ->join('lop', 'id_lop_moi', '=', 'lop.id')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('doi_lop_khoa.*', 'users.id as user_id', 'users.name', 'lop.ten_lop', 'lop.id as lop_id', 'khoa_hoc.ten_khoa_hoc')
            ->get();
        $data = DB::table('lop')->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('lop.*', 'khoa_hoc.ten_khoa_hoc')->get();
        return view('Admin.doi_lop.index', compact('doi_lop_khoa', 'data'));
    }
    public function updateStatus($doilop, Request $request)
    {
        // dd($request->all());
        $data = DoiLopKhoa::find($doilop);
        if ($data->status == 0) {
            // $data = DoiLopKhoa::find($doilop);
            $data->status = $request->status;
            session()->flash('sucssec', 'đơn hàng đã được cập nhật');
            $data->save();
            // lop cu thay doi so luong
            $lop_cu = Lop::find($request->id_lopcu);
            $lop_cu->so_luong = $lop_cu->so_luong + 1;
            // lop moi thay doi so luong
            $lop_moi = Lop::find($request->id_lopmoi);
            $lop_moi->so_luong = $lop_moi->so_luong - 1;
            // dang ky thay doi id lop
            $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
                ->where('id_user', '=', $request->user_id)
                ->update(['dang_ky.id_lop' => $lop_moi->id]);
            // dd($dang_ky);
            // luu du lieu
            $lop_cu->save();
            $lop_moi->save();
            return redirect()->back();
        } elseif ($data->status) {
            $data->status = $request->status;
            session()->flash('sucssec', 'đơn hàng đã được cập nhật');
            $data->save();

            // lop cu thay doi so luong
            $lop_cu = Lop::find($request->id_lopcu);
            $lop_cu->so_luong = $lop_cu->so_luong + 1;
            // lop moi thay doi so luong
            $lop_moi = Lop::find($request->id_lopmoi);
            $lop_moi->so_luong = $lop_moi->so_luong - 1;
            // dang ky thay doi id lop
            $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
                ->where('id_user', '=', $request->user_id)
                ->update(['dang_ky.id_lop' => $lop_moi->id]);

            // ghi no
            $khoahoc_cu = KhoaHoc::find($lop_cu->id_khoa_hoc);
            $khoahoc_moi = KhoaHoc::find($lop_moi->id_khoa_hoc);
            // 
            $kk = GhiNo::where('user_id', '=', $data->id_user)->first()->get();
            // dd($kk);
            foreach ($kk as  $value) {
                $tien = $khoahoc_cu->gia_khoa_hoc + $value->tien_no - $khoahoc_moi->gia_khoa_hoc;
                // dd($tien);
                $value->tien_no = $tien;
                $value->save();
                // if ($tien > 0) {
                //     $ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['tien_no' => $value->tien_no + $tien]);
                //     $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['trang_thai' => 1]); //hoc vien no

                // } elseif ($tien < 0) {
                //     $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['tien_no' => $value->tien_no + $tien]);
                //     // 
                //     $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['trang_thai' => 1]); //trung tam  no           
                // } else {
                //     $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['tien_no' => $value->tien_no + $tien]);
                //     // 
                //     $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                //         ->update(['trang_thai' => 0]); //het no
                // }
            }
            return redirect()->back();
        }
    }
}
