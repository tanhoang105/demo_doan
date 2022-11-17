<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThuHocController extends Controller
{

    protected $v, $thuhoc;

    public function __construct()
    {
        $this->v = [];
        $this->thuhoc = new ThuHoc();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $list = $this->thuhoc->index($this->v['params'], true, 10);
        $this->v['list'] = $list;

        return view('admin.thuhoc.index', $this->v);
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
            $res = $this->thuhoc->create($params);
            if ($res > 0) {
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_BE_Admin_List_Thu_Hoc');
            } else {
                Session::flash('error', "Thêm không thành công");
                return redirect()->route('route_BE_Admin_List_Thu_Hoc');
            }
        }

        return view('admin.thuhoc.add');
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
            $res = $this->thuhoc->show($id);
            if ($res) {
                $this->v['res'] = $res;
                return view('admin.thuhoc.update', $this->v);
            } else {
                Session::flash('error', "Lỗi không thể chỉnh sửa");
                return back();
            }
        } else {
            Session::flash('error', "Lỗi không thể chỉnh sửa");
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
            $res = $this->thuhoc->saveupdate($params);
            if ($res > 0) {
                Session::flash('success', 'Update thành công');
            } else {
                Session::flash('error', "Update không thành công");
            }
            return redirect()->route('route_BE_Admin_List_Thu_Hoc');
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
            $res = $this->thuhoc->remove($id);
            if ($res) {
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', 'Xóa thành công');
                return back();
            }
        }
    }
}
