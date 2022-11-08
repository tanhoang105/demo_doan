<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\XepLop;
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
        $this->xeplop = new XepLop();
    }
    public function index(Request $request)
    {

        $this->v['params'] = $request->all();

        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 6);
        $this->v['khoahoc'] = $khoahoc;
//            dd($khoahoc);

        $xeplop = $this->xeplop->index($this->v['params'], true, 6);
        $this->v['khaigiang'] = $xeplop;
//        dd($xeplop);

        return view('client.trang-chu.trang-chu', $this->v);
    }
}
