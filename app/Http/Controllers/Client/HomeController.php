<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\DangKy;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\ThuHoc;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    protected $v;
    protected $khoahoc, $cathu, $lop, $thu, $cahoc;

    public function __construct()
    {
        $this->v = [];
        $this->khoahoc  = new KhoaHoc();
        $this->danhmuc = new DanhMuc();
        $this->xeplop = new XepLop();
        $this->banner = new Banner();
        $this->cathu = new CaThu();
        $this->lop = new Lop();
        $this->thu = new ThuHoc();
        $this->cahoc = new CaHoc();
    }

    public function index(Request $request)
    {

        $this->v['params'] = $request->all();

        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 6);
        $this->v['khoahoc'] = $khoahoc;
        $this->v['cathu'] = $this->cathu->index(null, false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['cahoc'] = $this->cahoc->index(null, false, null);


        $xeplop = $this->xeplop->index($this->v['params'], true, 6);
        $this->v['khaigiang'] = $xeplop;
        //    dd($xeplop);
        $lopList  = $this->lop->index(null, false, null);
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
        $banner = $this->banner->index(null, false, null);
        $this->v['banner'] = $banner;

        // $id =  1;
        // $hocvien = DB::select(DB::raw("SELECT COUNT(dang_ky.id_user) FROM dang_ky JOIN lop ON lop.id = dang_ky.id_lop JOIN khoa_hoc ON khoa_hoc.id = lop.id_khoa_hoc WHERE khoa_hoc.id = ".$id.""));
        // dd($hocvien);

        return view('client.trang-chu.trang-chu', compact('hocvien'), $this->v);
    }
}
