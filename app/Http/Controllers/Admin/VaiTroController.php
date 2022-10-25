<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VaitroRequest;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VaiTroController extends Controller
{

    protected $v;
    protected $vaitro;
    public function __construct()
    {
        $this->v = [];
        $this->vaitro = new VaiTro();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $list = $this->vaitro->index($this->v['params'], true, 2);
        $this->v['list'] = $list;
        return view('admin.vaitro.index', $this->v);
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
    public function store(VaitroRequest $request)
    {
        // thực hiện code thêm ở đây

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

            $res =  $this->vaitro->create($params);
            if ($res > 0) {
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Vai_Tro');
            } else {
                Session::flash('success', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_Vai_Tro');
            }
        }

        return view('admin.vaitro.add');
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
            // nếu có id bản ghi chỉnh sửa
            $request->session()->put('id', $id);
            $res = $this->vaitro->show($id);
            $this->v['detail'] = $res;
            return view('admin.vaitro.update', $this->v);
        } else {
            Session::flash('error', 'Đã xảy ra lỗi');
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
    public function update(VaitroRequest $request)
    {
        //
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
        if ($request->file('hinh_anh')) {
            $params['cols']['hinh_anh'] =  $this->uploadFile($request->file('hinh_anh'));
        }

        $res = $this->vaitro->saveupdate($params);
        if ($res > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('route_BE_Admin_Vai_Tro');
        } else {
            Session::flash('error', 'Cập nhập không thành công');
            return redirect()->route('route_BE_Admin_Vai_Tro');
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
            // nếu có id của bản ghi xoas
            $res =  $this->vaitro->remove($id);
            if ($res > 0) {
                // xóa thành công
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('success', "Xóa thành công");
                return back();
            }
        }
    }

    public function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageVaiTro', $filename,  'public');
    }
}
