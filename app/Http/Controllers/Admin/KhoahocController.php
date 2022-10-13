<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;

class KhoahocController extends Controller
{
    protected $v;
    protected $khoahoc;

    public function __construct()
    {
        $this->v = [];
        $this->khoahoc  = new KhoaHoc();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khoahoc =  $this->khoahoc->index(null, false, null);
        return response()->json([
            'data' => $khoahoc,
            'status' => 200
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            // if ($request->file('anh_khoa_hoc')) {
            //     $file = $request->file('anh_khoa_hoc');
            //     $filename = date('YmdHi') . $file->getClientOriginalName();
            //     $file->move(public_path('/assets/admin/img_maybay'), $filename);
            // }
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
            // nếu có ảnh 
            if ($request->file('anh_khoa_hoc')) {
                $params['cols']['anh_khoa_hoc'] = $this->uploadFile($request->file('anh_khoa_hoc'));
            }
            $query = $this->khoahoc->create($params);
            if ($query > 0) {
                // thêm thành công bản ghi 

            } else {
                // không thêm thành công bản ghi

            }
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // lấy ra 1 bản ghi theo id
        if (!empty($id)) {
            $khoahoc = $this->khoahoc->show($id);
            return $khoahoc;
        } else {
            // nếu không tìm thấy id của bản ghi 

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // lấy ra dữ liệu bản ghi cần chỉnh sửa
        if (!empty($id)) {
            $request->session()->put('id', $id);
            $khoahoc = $this->khoahoc->show($id);
            return $khoahoc;
        } else {
            // nếu không tìm thấy id của bản ghi 

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // sau khi chỉnh sửa xong thì update vào cơ sở dữ liệu
        // cần thực hiện validate 
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
        if ($request->file('anh_khoa_hoc')) {
            $params['cols']['anh_khoa_hoc'] = $this->uploadFile($request->file('anh_khoa_hoc'));
        }
        // dd($params);
        $query  = $this->khoahoc->saveupdate($id, $params);
        if ($query > 0) {
            // update thành công
        } else {
            // update không thành công 
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
        // xóa bản ghi theo id - xóa mềm

    }


    // hàm upload ảnh 
    public function uploadFile($file)
    {
        $filename =  time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('ing_khoa_hoc', $filename,  'public');
    }
}
