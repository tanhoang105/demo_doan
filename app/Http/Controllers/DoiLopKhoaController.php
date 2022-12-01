<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\Senmail2;
use App\Models\DangKy;
use App\Models\DoiLopKhoa;
use App\Models\GhiNo;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DoiLopKhoaController extends Controller
{
    public function index()
    {
        $doi_lop_khoa = DoiLopKhoa::join('users', 'users.id', '=', 'id_user')
            ->join('lop', 'id_lop_moi', '=', 'lop.id')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('doi_lop_khoa.*', 'users.id as user_id', 'users.name', 'lop.ten_lop', 'lop.id as lop_id', 'khoa_hoc.ten_khoa_hoc', 'khoa_hoc.gia_khoa_hoc')
            ->get();
        $data = DB::table('lop')->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('lop.*', 'khoa_hoc.ten_khoa_hoc', 'khoa_hoc.gia_khoa_hoc')->get();
        return view('Admin.doi_lop.index', compact('doi_lop_khoa', 'data'));
    }
    public function updateStatus($doilop, Request $request)
    {
        // dd($request->all());
        $data = DoiLopKhoa::find($doilop);
        // dd($data->status);
        if ($data->status == 0) {
            dd('123');
            // $data = DoiLopKhoa::find($doilop);
            $data->status = $request->status;
            session()->flash('sucssec', 'đơn hàng đã được cập nhật');
            // $data->save();
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
            // dd($request->status);
            if ($request->status == 3) {
                // dd(1);
                $data->status = $request->status;
                $data->save();
                Mail::to('hoandepzai00@gmail.com')->send(new Senmail2([
                    'message' => 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi'
                ]));
                session()->flash('sucssec', 'Yêu cầu đã được cập nhật');
                return redirect()->back();
            } elseif ($request->status == 4) {
                // dd('thnah toan');
                $data->status = $request->status;
                // session()->flash('sucssec', 'đơn hàng đã được cập nhật');
                // $data->save();

                // lop cu thay doi so luong
                $lop_cu = Lop::find($request->id_lopcu);
                $lop_cu->so_luong = $lop_cu->so_luong + 1;
                // lop moi thay doi so luong
                $lop_moi = Lop::find($request->id_lopmoi);
                $lop_moi->so_luong = $lop_moi->so_luong - 1;
                // dang ky thay doi id lop
                // $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
                //     ->where('id_user', '=', $request->user_id)
                //     ->update(['dang_ky.id_lop' => $lop_moi->id]);

                // ghi no
                $khoahoc_cu = KhoaHoc::find($lop_cu->id_khoa_hoc);
                $khoahoc_moi = KhoaHoc::find($lop_moi->id_khoa_hoc);
                // 
                $kk = GhiNo::where('user_id', '=', $data->id_user)->first()->get();
                // dd($kk);
                foreach ($kk as  $value) {
                    $tien = $khoahoc_cu->gia_khoa_hoc + $value->tien_no - $khoahoc_moi->gia_khoa_hoc;
                    // dd($tien);
                    if ($value->tien_no > 0) {
                        // $ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['tien_no' => $tien]);
                        // // 
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['trang_thai' => 1]); //hoc vien no
                        // 
                        $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
                            ->where('id_user', '=', $request->user_id)
                            ->update(['dang_ky.id_lop' => $lop_moi->id]);
                        $lop_moi->save();
                        $lop_cu->save();
                        $data->save();
                        session()->flash('sucssec', 'Yêu cầu đã được cập nhật');
                    } elseif ($value->tien_no < 0) {
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['tien_no' => $tien]);
                        // // 
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['trang_thai' => 2]); //trung tam  no           
                        session()->flash('error', 'Tài khoản chưa thanh toán khoản nợ !');
                    } else {
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['tien_no' => $tien]);
                        // // 
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['trang_thai' => 0]); //het no
                        $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
                            ->where('id_user', '=', $request->user_id)
                            ->update(['dang_ky.id_lop' => $lop_moi->id]);
                        $lop_moi->save();
                        $lop_cu->save();
                        $data->save();
                        session()->flash('sucssec', 'Yêu vầu đã được cập nhật');
                        return redirect()->back();
                    }
                    // $value->tien_no = $tien;
                    // $value->save();
                }
            } elseif ($request->status == 2) {
                // dd('xac nhan'); 
                session()->flash('sucssec', 'Yêu cầu đã được cập nhật');
                return redirect()->back();
            }
        }
    }
    // them doi_khoa admin
    public function create()
    {
        $list_khoa_hoc = KhoaHoc::all();
        return view('Admin.doi_lop.add', compact('list_khoa_hoc'));
    }
    public function hienthidoilop($request)
    {
        // dd($request);
        // dd($request->ma_hoc_vien);
        $khoahoc = DangKy::where('dang_ky.id_user', '=', $request)
            ->join('lop', 'lop.id', '=', 'dang_ky.id_lop')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->join('users', 'users.id', '=', 'dang_ky.id_user')
            ->select('dang_ky.*', 'khoa_hoc.ten_khoa_hoc', 'users.name', 'lop.id as id_lop')
            ->get();
        // dd($khoahoc);
        return response()->json($khoahoc);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = new DoiLopKhoa();
        $data->fill($request->all());
        $data->save();
        // lop cu thay doi so luong
        $lop_cu = Lop::find($request->id_lop_cu);
        $lop_cu->so_luong = $lop_cu->so_luong + 1;
        // lop moi thay doi so luong
        $lop_moi = Lop::find($request->id_lop_moi);
        $lop_moi->so_luong = $lop_moi->so_luong - 1;
        // dang ky thay doi id lop
        $dang_ky = DangKy::where('id_lop', '=', $lop_cu->id)
            ->where('id_user', '=', $request->id_user)
            ->update(['dang_ky.id_lop' => $lop_moi->id]);
        return redirect()->route('route_BE_Admin_danh_sach_doi_lop');
    }
}
