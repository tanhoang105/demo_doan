<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoilopRequest;
use App\Mail\SendMail;
use App\Mail\sendmail3;
use App\Mail\Senmail2;
use App\Mail\Thanh_toan_thanh_cong;
use App\Models\DangKy;
use App\Models\DoiLopKhoa;
use App\Models\GhiNo;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DoiLopKhoaController extends Controller
{
    protected $giangvien;
    public function __construct()
    {
        $this->giangvien = new GiangVien();
    }

    public function index(Request $request)
    {
        $status = $request->trang_thai;

        $doi_lop_khoa = DoiLopKhoa::join('users', 'users.id', '=', 'id_user')
            ->join('lop', 'id_lop_moi', '=', 'lop.id')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('doi_lop_khoa.*', 'users.id as user_id', 'users.name', 'lop.ten_lop', 'lop.id as lop_id', 'khoa_hoc.ten_khoa_hoc', 'khoa_hoc.gia_khoa_hoc')
            ->search()
            ->get();
        $data = DB::table('lop')->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('lop.*', 'khoa_hoc.ten_khoa_hoc', 'khoa_hoc.gia_khoa_hoc')->get();

        $loc_trang_thai = DoiLopKhoa::join('users', 'users.id', '=', 'id_user')
            ->join('lop', 'id_lop_moi', '=', 'lop.id')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->select('doi_lop_khoa.*', 'users.id as user_id', 'users.name', 'lop.ten_lop', 'lop.id as lop_id', 'khoa_hoc.ten_khoa_hoc', 'khoa_hoc.gia_khoa_hoc')
            ->where('doi_lop_khoa.status', '=', $request->trang_thai)
            ->get();
        return view('Admin.doi_lop.index', compact('doi_lop_khoa', 'data', 'loc_trang_thai', 'status'));
    }
    public function updateStatus($doilop, Request $request)
    {
        $lop_cu = Lop::find($request->id_lopcu);
        $lop_moi = Lop::find($request->id_lopmoi);
        // 
        $user = User::find($request->user_id);
        $mail = $user->email;
        // dd($mail);
        // dd($request->all());
        $data = DoiLopKhoa::find($doilop);
        // dd($data->status);
        if ($data->status == 0) {
            // dd('123');
            // $data = DoiLopKhoa::find($doilop);
            $data->status = $request->status;
            session()->flash('sucssec', 'Trạng thái yêu cầu đã được cập nhật');
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
            Mail::to($mail)->send(new sendmail3([
                'message' => 'Xin chào bạn , Bạn vừa đăng ký đổi lớp thành công',
                'lop_cu' => $lop_cu->ten_lop,
                'lop_moi' => $lop_moi->ten_lop,
                'ngay_xac_nhan' => date(now()),
            ]));
            $lop_cu->save();
            $lop_moi->save();
            $data->save();
            return redirect()->back();
        } elseif ($data->status) {
            // dd($request->status);
            if ($request->status == 3) {
                // dd(1);
                $data->status = $request->status;
                $data->save();
                $kk = DoiLopKhoa::find($doilop);
                $khoa_hoc_cu = KHoaHoc::find($lop_cu->id_khoa_hoc);
                $khoa_hoc_moi = KHoaHoc::find($lop_moi->id_khoa_hoc);
                $khoan_no = $khoa_hoc_moi->gia_khoa_hoc - $khoa_hoc_cu->gia_khoa_hoc;
                // dd($khoa_hoc_cu);
                Mail::to($mail)->send(new Senmail2([
                    'message' => 'Xin chào bạn, yêu cầu đổi khóa học của bạn đã được xác nhận',
                    'khoa_hoc_cu' => $khoa_hoc_cu->ten_khoa_hoc,
                    'khoa_hoc_moi' => $khoa_hoc_moi->ten_khoa_hoc,
                    'khoan_no' => $khoan_no,
                    'ngay_xac_nhan' => date(now()),
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
                        Mail::to($mail)->send(new Thanh_toan_thanh_cong([]));
                        session()->flash('sucssec', 'Yêu cầu đã được cập nhật');
                        return redirect()->back();
                    } elseif ($value->tien_no < 0) {
                        dd($value->tien_no);
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['tien_no' => $tien]);
                        // // 
                        // $trang_thai_ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
                        //     ->update(['trang_thai' => 2]); //trung tam  no           
                        session()->flash('error', 'Tài khoản chưa thanh toán khoản nợ !');
                        return redirect()->back();
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
                        Mail::to($mail)->send(new Thanh_toan_thanh_cong([]));
                        return redirect()->back();
                    }
                    // $value->tien_no = $tien;
                    // $value->save();
                }
            } elseif ($request->status == 2) {
                // dd('xac nhan'); 
                session()->flash('sucssec', 'Yêu cầu đã được cập nhật');
                return redirect()->back();
            } elseif ($request->status == 5) {
                // dd($request->all());
                $data->status = $request->status;
                $data->save();
                session()->flash('sucssec', 'Đã từ chối yêu cầu đổi lớp !');
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
    public function siso_doilop(Request $request)
    {
        // dd($request->all());
        $attribute = Lop::find($request->id_lop_moi);

        $giangvien = $this->giangvien->SearchGVWithIdUser($attribute->id_giang_vien);
        $giangvien = $giangvien->ten_giang_vien;
        $ghe_trong = $attribute->so_luong;

        // dd( $attribute); 
        // 'giangvien' => $giangvien->ten_giang_vien
        return response()->json(['success' => true, 'ghe_trong' => $ghe_trong, 'giangvien' => $giangvien]);
    }
    public function store(DoilopRequest $request)
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
    public function Xoa_Yc_doi_Khoa_Hoc($id)
    {
        // dd($id);
        $data = DoiLopKhoa::find($id);
        if ($data->status == 1 || $data->status == 4 || $data->status == 5) {
            $data->delete();
            session()->flash('sucssec', 'Đã xóa thành công !');
            return redirect()->back();
        } else {
            session()->flash('error', 'yêu cầu chưa được xử lý !');
            return redirect()->back();
        }
    }
    public function loc_theo_trang_thai(Request $request)
    {
        dd($request->trang_thai);
        if ($request->trang_thai == 0) {
            $result = DoiLopKhoa::where('status', '=', 2)->get();
            // 
            // $result = array_merge($data, $data2);
            // dd($result);
        }
        if ($request->trang_thai == 1) {
            $result = DoiLopKhoa::
                // where('status','=',0)
                where('status', '=', 3)
                ->get();
        }
        if ($request->trang_thai == 2) {
            $result = DoiLopKhoa::
                // where('status','=',0)
                where('status', '=', 4)
                ->get();
        }
        if ($request->trang_thai == 3) {
            $result = DoiLopKhoa::where('status', '=', 5)->get();
            return redirect()->route('route_BE_Admin_danh_sach_doi_lop', compact('data'));
        }
    }
}
