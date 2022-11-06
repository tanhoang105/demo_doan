<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhuyenmaiRequest;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KhuyenMaiController extends Controller
{
    protected $v;
    protected $khuyenmai;

    public function __construct()
    {
        $this->v = [];
        $this->khuyenmai = new KhuyenMai();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->v['params']  = $request->all();
        $this->v['list'] = $this->khuyenmai->index($this->v['params'], true, 10);
        return view('admin.khuyenmai.index', $this->v);
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
    public function store(KhuyenmaiRequest $request)
    {
        //
        $this->v['params'] = $request->all();
        if ($request->isMethod("POST")) {
            $params = [];
            // dd($request->post());
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
            $res = $this->khuyenmai->create($params);
            if ($res > 0) {
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_BE_Admin_Khuyen_Mai');
            } else {
                Session::flash('error', "Thêm không thành công");
                return redirect()->route('route_BE_Admin_Khuyen_Mai');
            }
        }
        return view('admin.khuyenmai.add', $this->v);
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
        //

        if ($id) {
            $request->session()->put('id', $id);
            $res = $this->khuyenmai->show($id);
            if($res){
                $this->v['khuyenmai']  = $res;
            }
            return view('admin.khuyenmai.update' ,$this->v);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KhuyenmaiRequest $request)
    {
        if (session('id')) {
            $id = session('id');
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
            $res = $this->khuyenmai->saveupdate($params);
            if ($res > 0) {
                Session::flash('success', "Cập nhập thành công");
                return redirect()->route('route_BE_Admin_Khuyen_Mai');
            } else {
                Session::flash('error', "Cập nhập không thành công");
                return redirect()->route('route_BE_Admin_Khuyen_Mai');
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
            $res = $this->khuyenmai->remove($id);
            if ($res > 0) {
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('success', 'Xóa thành công');
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
            $res = $this->khuyenmai->remoAll($params);
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
