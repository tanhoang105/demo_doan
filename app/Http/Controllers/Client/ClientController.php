<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;

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
        $this->v['params'] = $request->all();
        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 3);
        $this->v['list'] = $khoahoc;
//        dd($khoahoc);
        return view('client.index', $this->v);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function khoa_hoc(Request $request)
    {
        $this->v['params'] = $request->all();
        $khoahoc =  $this->khoahoc->index($this->v['params'], true, 3);
        $this->v['list'] = $khoahoc;
//        dd($khoahoc);
        return view('client.khoa_hoc', $this->v);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lien_he()
    {
        return view('client.lien_he', $this->v);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function giang_vien($request)
    {
        return view('client.giang_vien', $this->v);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gioi_thieu()
    {
        return view('client.gioi_thieu', $this->v);
    }
}

