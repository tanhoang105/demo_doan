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
use PhpParser\Node\Stmt\Echo_;

class XepLopController extends Controller
{
    protected $v;
    protected $xep_lop;
    protected $khoa_hoc;
    protected $ca_hoc, $lop_hoc, $giang_vien, $phong_hoc;

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
        $this->authorize(mb_strtoupper('xem xếp lớp'));

        $this->v['params'] = $request->all();


        $list = $this->xep_lop->index($this->v['params'], true, 10);
        $this->v['list'] = $list;
        //dd($list);
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
        $this->authorize(mb_strtoupper('thêm xếp lớp'));

        //
        if ($request->isMethod('POST')) {
            // check logic
            // dd($request->all());
            // cos id_phong
            // tu id_lop lay -> ca_thu_id
            // tu xep_lop join lop lay ra duoc ca thu lay ra duoc ca_thu_id va id_phong
            // $lop = Lop::find($request->id_lop);
            // $xep_lop_all = XepLop::join('lop', 'lop.id', '=', 'xep_lop.id_lop')
            //     ->select('xep_lop.*', 'lop.ca_thu_id')
            //     ->get();
            // // dd($xep_lop_all);
            // foreach ($xep_lop_all as $value) {

            //     if ($value->id_phong_hoc == $request->id_phong_hoc) {
            //         dd(3);
            //         if ($value->ca_thu_id == $lop->ca_thu_id) {
            //             dd('loi');
            //         } else {
            //             dd('duoc roi');
            //         }
            //     } else {
            //         dd('ok roi ');
            //     }
            // }
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
        $this->v['lophocdaxep'] = $this->xep_lop->index(null, false, null);
        // dd($this->v['lophocdaxep']);
        $arrayLopChuaXep = [];
        foreach ($this->v['lophoc'] as $itemLop) {
            if ($this->xep_lop->checkLop($itemLop->id)) {
            } else {
                $arrayLopChuaXep[] =  $itemLop;
            }
        }
        // dd($arrayLopChuaXep);
        $this->v['lopxep'] = $arrayLopChuaXep;
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
    public function edit($id, Request $request)
    {
        $this->authorize(mb_strtoupper('edit xếp lớp'));

        if (!empty($id)) {
            $request->session()->put('id', $id);

            $result  = $this->xep_lop->show($id);
            if ($result) {
                $this->v['res'] = $result;
                $this->v['listLop'] = $this->lop_hoc->index(null, false, null);
                $this->v['listGiangVien'] = $this->giang_vien->index(null, false, null);
                $this->v['listPhongHoc'] = $this->phong_hoc->index(null, false, null);
                // dd($this->v['res']);
                return view('admin.xeplop.update', $this->v);
            }
        } else {
            Session::flash('error', 'Lỗi chỉnh sửa');
            return back();
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
        $this->authorize(mb_strtoupper('update xếp lớp'));

        if (session('id')) {
            $id  =  session('id');

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
            $params['cols']['id'] = $id;
            // dd($params);
            $res = $this->xep_lop->saveupdate($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', "Cập nhập thành cônng");
                return redirect()->route('route_BE_Admin_Xep_Lop');
            } else {
                Session::flash('error', "Cập nhập không thành cônng");
                return redirect()->route('route_BE_Admin_Xep_Lop');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(mb_strtoupper('xóa xếp lớp'));

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


    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa xếp lớp'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['cols']['_token']);
            if (count(($params['cols'])) <= 0) {
                // dd(123);
                Session::flash('error , "Xóa không thành công');
                return back();
            }
            $res = $this->xep_lop->remoAll($params);
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
