<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    protected $v;
    protected $khoahoc;

    public function __construct()
    {
        $this->v = [];
        $this->khoahoc  = new KhoaHoc();
        $this->danhmuc = new DanhMuc();
        $this->lop = new Lop();
        $this->cahoc = new CaHoc();
    }
    public function index(Request $request)
    {
        $data = DB::table('giang_vien')->select('giang_vien.*')
            ->skip(0)->take(3)
            ->get();
        // dd($data);
        $this->v['params'] = $request->all();
        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 6);
        $this->v['khoahoc'] = $khoahoc;
        //    dd($khoahoc);


        $lop = $this->lop->index($this->v['params'], true, 5);
        $this->v['lop'] = $lop;
        return view('client.trang-chu.trang-chu', $this->v, compact('data'));
    }
}
