<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormDoiLopClientRequest;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\DoiLopKhoa;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\ThuHoc;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LopController extends Controller
{
    protected $v;
    protected $xeplop, $cathu, $thu, $cahoc, $lop;

    public function __construct()
    {
        $this->v = [];
        $this->xeplop = new XepLop();
        $this->cahoc = new CaHoc();
        $this->cathu = new CaThu();
        $this->lop = new Lop();
        $this->thu = new ThuHoc();
    }
    public function index(Request $request)
    {
        $list = DangKy::join('lop', 'dang_ky.id_lop', '=', 'lop.id')
            ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
            ->join('giang_vien', 'giang_vien.id_user', '=', 'lop.id_giang_vien')
            ->join('ca_thu', 'ca_thu.id', '=', 'lop.ca_thu_id')
            ->where('dang_ky.id_user', '=', Auth::user()->id)
            ->select('dang_ky.*', 'khoa_hoc.ten_khoa_hoc', 'giang_vien.ten_giang_vien', 'ca_thu.ca_id', 'lop.ten_lop', 'lop.ca_thu_id' , 'lop.ngay_bat_dau', 'lop.so_luong', 'lop.id as lop_id', 'khoa_hoc.id as khoa_hoc_id')
            ->get();
        $this->v['list'] = $list;
        //    dd($list);
        $list_lop_moi = XepLop::join('lop', 'xep_lop.id_lop', '=', 'lop.id')
            ->where('lop.so_luong', '<', 40)
            ->select('xep_lop.*', 'lop.*')
            ->get();
        $this->v['list_lop_moi'] = $list_lop_moi;
        // dd($list_lop_moi);
        $this->v['params'] = $request->all();
        $this->v['cathu'] = $this->cathu->index($this->v['params'], false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['cahoc'] = $this->cahoc->index(null, false, null);


        return view('client.lop.lop', $this->v);
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

        // hiển thị ca học cho lớp 
         // dd($list_lop_moi);
         $this->v['params'] = $request->all();
         $this->v['cathu'] = $this->cathu->index($this->v['params'], false, null);
         $cathu =  $this->v['cathu'];
         $this->v['thu'] = $this->thu->index(null, false, null);
         $thu =  $this->v['thu'];
         $this->v['cahoc'] = $this->cahoc->index(null, false, null);
         $cahoc =  $this->v['cahoc'];
         
 
         $xeplop = $this->xeplop->index($this->v['params'], true, 6);
         $this->v['khaigiang'] = $xeplop;
         //    dd($xeplop);
         $lopList  = $this->lop->index(null, false, null);
         $this->v['lopList'] = $lopList;
         $array = [];
         for ($i = 0; $i < count($xeplop); $i++) {
             for ($j = 0; $j < count($lopList); $j++) {
                 if ($xeplop[$i]->id_lop == $lopList[$j]->id) {
                     $array[] =  $lopList[$j];
                 }
             }
         }
         // dd($array);
         $this->v['array'] = $array;

        // dd($lop_moi);
        return view('client.lop.form_doi_lop', compact('lop_cu', 'lop_moi', 'xep_lop' , 'array' , 'cathu' , 'thu' , 'cahoc'));
    }
    public function doi_lop(FormDoiLopClientRequest $request)
    {
        // dd($request->all());
        $lop_cu = Lop::find($request->id_lop_cu);
        $lop_moi = Lop::find($request->id_lop_moi);
        // 
        // check trung lop ca_thu 
        $all_lop_cu = DangKy::where('dang_ky.id_user', '=', Auth::user()->id)
            ->join('lop', 'lop.id', '=', 'dang_ky.id_lop')
            ->whereNotIn('dang_ky.id_lop', [$lop_cu->id])
            ->where('lop.ca_thu_id', '=', $lop_moi->ca_thu_id)
            ->get();
        // dd($all_lop_cu);
        if ($all_lop_cu->count() > 0) {
            session()->flash('loi_trung', 'Bạn đã đăng kí trùng ca đang học');
            return redirect()->back();
        }
        // 
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
