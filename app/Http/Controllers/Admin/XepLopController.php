<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XeplopRequest;
use App\Models\CaHoc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\PhongHoc;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class XepLopController extends Controller
{
    protected $v;
    protected $xep_lop;
    protected $khoa_hoc;
    protected $ca_hoc;

    public function __construct()
    {
        $this->v = [];
        $this->xep_lop = new XepLop();
        $this->khoa_hoc = new KhoaHoc();
        $this->giang_vien = new GiangVien();
        $this->phong_hoc = new PhongHoc();
        $this->ca_hoc = new CaHoc();
        $this->lop_hoc = new Lop();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();

        $list = $this->xep_lop->index($this->v['params'], true, 3);
        $this->v['list'] = $list;

        return view('admin.xeplop.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // hiển thị ra form thêm
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // sau khi nhập dữ liệu thêm và submit form 
    public function store(XeplopRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            // thêm sản phẩm
            $params = [];
            $params['cols'] = array_map(function ($item) {
                if ($item == '') {
                    $item = null;
                }

                if (is_string($item)) {
                    $item = trim($item);
                }
                return $item;
            }, $request->post());

            unset($params['cols']['_token']);
            // dd($params);
            $res = $this->xep_lop->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', "Thêm thành cônng");
                return redirect()->route('route_BE_Admin_Xep_Lop');
            } else {
                Session::flash('error', "Thêm không thành cônng");
                return redirect()->route('route_BE_Admin_Xep_Lop');
            }
        }

        $this->v['khoahoc'] = $this->khoa_hoc->index(null, false, null);
        $this->v['giangvien'] = $this->giang_vien->index(null, false, null);
        $this->v['phonghoc'] = $this->phong_hoc->index(null, false, null);
        $this->v['cahoc'] = $this->ca_hoc->index(null, false, null);
        $this->v['lophoc'] = $this->lop_hoc->index(null, false, null);
        // dd($this->v['giangvien']);
        return view('admin.xeplop.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->v['result'] = $this->xep_lop->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {

            $result  = $this->xep_lop->show($id);
            if ($result) {
                // hiển thị dữ liệu lên form chỉnh sửa
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(XeplopRequest $request)
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
        if (!empty($id)) {

            $query =  $this->xep_lop->remove($id);
            if ($query > 0) {
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công');
                return back();
            }
        }
    }
}
