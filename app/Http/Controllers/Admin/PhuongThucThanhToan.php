<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuongThucThanhToan as ModelsPhuongThucThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhuongThucThanhToan extends Controller
{

    protected $v;
    protected $phuong_thuc_thanh_toan;

    public function __construct()
    {
        $this->v = [];
        $this->phuong_thuc_thanh_toan = new ModelsPhuongThucThanhToan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $this->v['list']  =  $this->phuong_thuc_thanh_toan->index($this->v['params'], true, 5);
        return view('admin.phuongthucthanhtoan.index', $this->v);
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
        //
        if ($request->isMethod('POST')) {
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
            $res = $this->phuong_thuc_thanh_toan->create($params);
            if ($res > 0) {
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_BE_Admin_Phuong_Thuc_Thanh_Toan');
            } else {
                Session::flash('error', "Thêm không  thành công");
                return redirect()->route('route_BE_Admin_Phuong_Thuc_Thanh_Toan');
            }
        }
        return view('admin.phuongthucthanhtoan.add');
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
    public function edit($id, Request $request)
    {
        if ($id) {
            $request->session()->put('id', $id);
            $res  = $this->phuong_thuc_thanh_toan->show($id);
            if ($res) {
                $this->v['res'] = $res;
                return view('admin.phuongthucthanhtoan.update', $this->v);
            } else {
                Session::flash('error', "Lỗi , không tìm thấy bản ghi");
                return back();
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
    public function update(Request $request)
    {
        if (session('id')) {
            $id = session('id');
            $params  = [];
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
            $res = $this->phuong_thuc_thanh_toan->saveupdate($params);
            if ($res > 0) {
                Session::flash('success', 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_Phuong_Thuc_Thanh_Toan');
            } else {
                Session::flash('success', 'Cập nhập không thành công');
                return redirect()->route('route_BE_Admin_Phuong_Thuc_Thanh_Toan');
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
            $res = $this->phuong_thuc_thanh_toan->remove($id);
            if ($res > 0) {
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', "Xóa không thành công");
                return back();
            }
        }
    }

    public function destroyAll(Request $request){
        // dd($request->all);
        // $request  =  $request->all();
        if($request->isMethod('POST')){
            $params = [];
            $params['cols'] = array_map(function($item){
                return $item;
            } , $request->all());
            unset($params['_token']);
            $res = $this->phuong_thuc_thanh_toan->remoAll($params);
            // dd($res);

            if($res > 0){
                Session::flash('success , "Xóa thành công');
                return back();
            }else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
          
        }
    }
}
