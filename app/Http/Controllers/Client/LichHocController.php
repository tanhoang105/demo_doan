<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\LichHoc;
use App\Models\Lop;
use App\Models\PhongHoc;
use App\Models\ThuHoc;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LichHocController extends Controller
{

    protected  $v, $lichHoc, $thuhoc, $phonghoc , $khoahoc , $lop , $giang_vien , $ca_hoc;
    public function __construct()
    {
        $this->v = [];
        $this->lichHoc = new LichHoc();
        $this->thuhoc = new ThuHoc();
        $this->phonghoc = new PhongHoc();
        $this->khoahoc = new KhoaHoc();
        $this->lop = new Lop();
        $this->giang_vien = new GiangVien();
        $this->ca_hoc = new CaHoc();
      
    }
    public function index()
    {
        $idUser = Auth::user()->id;
        // dd($idUser);
        $listThuHoc = $this->thuhoc->index(null, false, null);
        $this->v['thuhoc'] = $listThuHoc;
        $this->v['phonghoc'] = $this->phonghoc->index(null, false, null);
        $this->v['khoa_hoc'] = $this->khoahoc->index(null  , false , null);
        $this->v['lop'] = $this->lop->index(null , false , null);
        $this->v['giang_vien'] = $this->giang_vien->index(null , false , null);
        $this->v['ca_hoc'] = $this->ca_hoc->index(null , false , null);

        $params['id'] = $idUser;
        $list = $this->lichHoc->index($params, false, null);
        $this->v['list'] = $list;
        // dd($list);

        return view('client.lich-hoc.lich-hoc', $this->v);
    }
}
