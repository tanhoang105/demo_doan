<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChoPhep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class PhanQuyenController extends Controller
{

    protected $v, $quyen;

    public function __construct()
    {
        $this->v = [];
        $this->quyen = new ChoPhep();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize(mb_strtoupper('xem phân quyền'));

        $this->v['params'] = $request->all();
        $this->v['list'] = $this->quyen->index($this->v['params'], true, 10);
        return view('admin.quyen.index', $this->v);
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
        // $this->authorize(mb_strtoupper('thêm phân quyền'));

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
            $res = $this->quyen->create($params);
            if ($res > 0) {
                Session::flash('success', "Thêm thành công ");
                // return redirect()->route('route_BE_Admin_List_Quyen');
                return back();
            } else {
                Session::flash('success', "Thêm không thành công ");
                return redirect()->route('route_BE_Admin_List_Quyen');
            }
        }

        return view('admin.quyen.add');
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
        // $this->authorize(mb_strtoupper('edit phân quyền'));

        if ($id) {
            $request->session()->put('id', $id);
            $res = $this->quyen->show($id);
            if ($res) {
                $this->v['res'] = $res;
                return view('admin.quyen.update', $this->v);
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

        // $this->authorize(mb_strtoupper('update phân quyền'));

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
            $params['cols']['id'] = session('id');
            $res = $this->quyen->saveupdate($params);
            if ($res > 0) {
                Session::flash('success', "Cập nhập thành công ");
                return redirect()->route('route_BE_Admin_List_Quyen');
            } else {
                Session::flash('success', "Cập nhập không thành công ");
                return redirect()->route('route_BE_Admin_List_Quyen');
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
        $this->authorize(mb_strtoupper('xóa phân quyền'));

        if ($id) {
            $res = $this->quyen->remove($id);
            if ($res > 0) {
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công');
                return back();
            }
        }
    }
}
