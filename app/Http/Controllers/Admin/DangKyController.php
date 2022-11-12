<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\PhuongThucThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DangKyController extends Controller
{
    protected $v, $dangky, $lop, $khoahoc, $phuongthucthanhtoan;

    public function __construct()
    {
        $this->v = [];
        $this->dangky = new DangKy();
        $this->lop = new Lop();
        $this->khoahoc = new KhoaHoc();
        $this->phuongthucthanhtoan = new PhuongThucThanhToan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem đăng ký') );

        $this->v['params'] = $request->all();
        $this->v['list'] = $this->dangky->index($this->v['params'], true, 10);

        // dd($this->v['list']);
        return view('admin.dangky.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(mb_strtoupper('thêm đăng ký') );

        $lop = $this->lop->index(null, false, null);
        $this->v['lop'] =  $lop;

        $this->v['listthanhtoan'] = $this->phuongthucthanhtoan->index(null ,  false , null);
        // dd($this->v['listthanhtoan']);
        if ($request->isMethod('POST')) {
        }


        return view('admin.dangky.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa đăng ký') );

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->dangky->remoAll($params);
            // dd($res);

            if ($res > 0) {
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }
}
