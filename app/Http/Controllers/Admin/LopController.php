<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LopRequest;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LopController extends Controller
{
    protected $v;
    protected $lophoc;
    protected $khoahoc;

    public function __construct()
    {
        $this->v = [];
        $this->lophoc =  new Lop();
        $this->giangvien  = new  GiangVien();
        $this->khoahoc = new KhoaHoc();
    }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] =  $request->all();
        $list = $this->lophoc->index($this->v['params'], true, 5);
        $this->v['giangvien'] = $this->giangvien->index($this->v['params'], false, null);
        // dd($this->v['giangvien']);
        $this->v['list'] = $list;

        return view('admin.lop.index', $this->v);
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
    public function store(LopRequest $request)
    {
        //

        $this->v['khoahoc'] = $this->khoahoc->index(null, false, null);
        $this->v['giangvien'] = $this->giangvien->index(null, false, null);
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
            $res = $this->lophoc->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('seccuss', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_List_Lop');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_List_Lop');
            }
        }

        return view('admin.lop.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        if ($id) {
            $request->session()->put('id', $id);
            $this->v['khoahoc'] = $this->khoahoc->index(null, false, null);
            $this->v['giangvien'] = $this->giangvien->index(null, false, null);
            // dd($this->v['khoahoc']);
            $this->v['lop'] = $this->lophoc->show($id);
            // dd($this->v['lop']);
            return view('admin.lop.update', $this->v);
        } else {
            Session::flash('error', 'Lỗi');
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
    public function update(LopRequest $request)
    {

        if (session('id')) {
            $id = session('id');
            // dd($id);
            $params  = [];
            $params['cols'] = array_map(function ($item) {
                if ($item == '') {
                    $item  = null;
                }
                if (is_string($item)) {
                    $item = $item;
                }

                return $item;
            }, $request->post());
            unset($params['cols']['_token']);
            $params['cols']['id'] = $id;

            // dd($params);
            $res = $this->lophoc->saveupdate($params);
            if ($res > 0) {
                Session::flash('success', "Cập nhập thành công");
                return redirect()->route('route_BE_Admin_List_Lop');
            } else {
                Session::flash('error', "Cập nhập không thành công");
                return redirect()->route('route_BE_Admin_List_Lop');
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
        if ($id) {
            $res = $this->lophoc->remove($id);
            if ($res > 0) {
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', "Xóa không thành công");
                return back();
            }
        } else {
            Session::flash('error', 'Lỗi xảy ra');
            return back();
        }
    }

    public function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imgLopHoc', $filename, 'public');
    }
}
