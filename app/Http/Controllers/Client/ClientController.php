<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    protected $v;
    protected $khoahoc;

    public function __construct()
    {
        $this->v = [];
        $this->khoahoc  = new KhoaHoc();
        $this->danhmuc = new DanhMuc();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('giang_vien')->select('giang_vien.*')
            ->skip(0)->take(3)
            ->get();
        // dd($data);
        $this->v['params'] = $request->all();
        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 3);
        $this->v['list'] = $khoahoc;
        //    dd($khoahoc);
        return view('client.index', $this->v, compact('data'));
    }
    public function gioi_thieu()
    {
        return view('client.gioi_thieu');
    }
    public function khoa_hoc(Request $request)
    {
        // $data = DB::table('giang_vien')->select('giang_vien.*')
        // ->skip(0)->take(3)
        // ->get();
        // dd($data);
        // $this->v['params'] = $request->all();
        // $khoahoc =  $this->khoahoc->index($this->v['params'], true, 3);
        // $this->v['list'] = $khoahoc;
        //    dd($khoahoc);
        $list = DB::table('khoa_hoc')->select('khoa_hoc.*')->get();
        return view('client.khoa_hoc', $this->v, compact('list'));
    }
    public function lien_he()
    {
        return view('client.lien_he');
    }
    public function giang_vien()
    {
        $giang_vien = DB::table('giang_vien')->select('giang_vien.*')
            ->get();
        // dd($data);
        return view('client.giang_vien', compact('giang_vien'));
    }
    public function khoa_hoc_chi_tiet($id)
    {
        $giang_vien = GiangVien::all();
        $detail = KhoaHoc::find($id);
        $lop = Lop::select('lop.*','giang_vien.ten_giang_vien')
            ->where('lop.id_khoa_hoc', '=', $id)
            ->join('giang_vien','lop.id_giang_vien','=','giang_vien.id')
            ->get();
        // dd($lop);
        // dd($detail);
        return view('client.khoa_hoc_chi_tiet', compact('detail', 'giang_vien','lop'));
    }
}
