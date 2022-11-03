<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhonghocRequest;
use App\Models\PhongHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhongHocController extends Controller
{

    protected $v;
    protected $phonghoc;

    public function __construct()
    {
        $this->v = [];
        $this->phonghoc = new PhongHoc();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $list = $this->phonghoc->index($this->v['params'], true, 10);
        $this->v['list'] = $list;
        return view('admin.phonghoc.index', $this->v);
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
    public function store(PhonghocRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols']  = array_map(function ($item) {
                if ($item == '') {
                    $item = null;
                }
                if (is_string($item)) {
                    $item = trim($item);
                }
                return $item;
            }, $request->post());

            unset($params['cols']['_token']);
            // nếu có ảnh
            if ($request->file('hinh_anh')) {
                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }

            $res =  $this->phonghoc->create($params);
            if ($res > 0) {
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Phong_Hoc');
            } else {
                Session::flash('success', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_Phong_Hoc');
            }
        }

        return view('admin.phonghoc.add');
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
    public function edit($id , Request $request)
    {
        //
        if($id){
            $request->session()->put('id' , $id);
            $phonghoc =  $this->phonghoc->show($id);
            $this->v['phonghoc'] = $phonghoc;
            return view('admin.phonghoc.update' , $this->v);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhonghocRequest $request)
    {
        $id = session('id');
        $params = [];
        $params['cols'] = array_map(function($item){
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        } , $request->post());
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        $res = $this->phonghoc->saveupdate($params);

        if($res > 0){
            Session::flash('success' , "Cập nhập thành công");
            return redirect()->route('route_BE_Admin_Phong_Hoc');
        }else {
            Session::flash('error' , "Cập nhập không thành công");
            return redirect()->route('route_BE_Admin_Phong_Hoc');
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
        //
        if ($id) {

            $res = $this->phonghoc->remove($id);
            if ($res > 0) {
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công');
                return back();
            }
        }

    }

    public function uploadFile($file){
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imagePhongHoc', $filename,  'public');

    }
}
