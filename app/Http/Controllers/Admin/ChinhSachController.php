<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChinhSach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChinhSachController extends Controller
{
    protected $v , $chinh_sach ;
    public function __construct()
    {
        $this->v = [];
        $this->chinh_sach = new ChinhSach();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params= $request->all();
        $this->v['list'] = $this->chinh_sach->index($params , true  , 10);
        return view('admin.chinhsach.index' ,$this->v);
       
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
        if($request->isMethod('POST')){
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
           
            $res =  $this->chinh_sach->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_BE_Admin_List_Chinh_Sach');
            } else {
                // thêm không thành công
                Session::flash('error', "Thêm không thành công");
                return redirect()->route('route_BE_Admin_List_Chinh_Sach');
            }
        }
        return view('admin.chinhsach.add');
    }

    public function NoiDung($id){
        $this->v['content'] = $this->chinh_sach->show($id);
        return view('admin.chinhsach.noidung' , $this->v);
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
        if ($id) {
            // dd($id);
            $this->v['params'] = $request->all();
            $request->session()->put('id', $id);
            $result = $this->chinh_sach->show($id);
            $this->v['res'] = $result;
            return view('admin.chinhsach.update', $this->v);
        } else {
            // nếu không tìm thấy id của bản ghi
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
    public function update(Request $request)
    {
        $id  = session('id');
        $params = [];
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
        $res  = $this->chinh_sach->saveupdate($params);
        if ($res > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('route_BE_Admin_List_Chinh_Sach');
        } else {
            Session::flash('error', 'Cập nhập không thành công');
            return back();
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
        $res = $this->chinh_sach->remove($id);
        if ($res > 0) {
            $this->chinh_sach->remove(null, $id);
            Session::flash('success', "Xóa thành công");
            return back();
        } else {
            Session::flash('error', 'Xóa không thành công');
            return back();
        }
    }
}
