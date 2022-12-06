<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RequestStack;

class DanhMucKhoaHoc extends Controller
{

    protected $v;
    protected $danh_muc, $khoahoc, $lop;

    public function __construct()
    {
        $this->v = [];
        $this->danh_muc = new DanhMuc();
        $this->khoahoc = new KhoaHoc();
        $this->lop  = new Lop();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem danh mục khóa học'));
        $this->v['pramas'] = $request->all();
        $list = $this->danh_muc->index($this->v, true, 10);
        $this->v['list'] = $list;
        $lop = $this->lop->index(null, false, null);
        $arrayIdKhoaHoc = [];
        foreach ($lop as  $itemLop) {
            $arrayIdKhoaHoc[] =  $itemLop->id_khoa_hoc;
        }
        $arrayIdKhoaHoc = array_unique($arrayIdKhoaHoc);
        $listKh = $this->khoahoc->DanhSachKhoaHocTheoIDKhoa($arrayIdKhoaHoc);
        // dd($listKh);

        $arrayIdDanhMuc = [];
        foreach ($listKh as  $itemKhoaHoc) {
            $arrayIdDanhMuc[] =  $itemKhoaHoc->id_danh_muc;
        }
        $arrayIdDanhMuc = array_unique($arrayIdDanhMuc);
        // dd($arrayIdDanhMuc);
        $this->v['arrayIdDanhMuc'] = $arrayIdDanhMuc;
        return view('Admin.danhmuc.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // không cần hàm này
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // hàm thêm mới bản ghi
    public function store(DanhMucRequest $request)
    {
        $this->authorize(mb_strtoupper('thêm danh mục khóa học'));

        $this->v['exParam'] = $request->all();
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
            if ($request->file('anh_danh_muc')) {
                // hàm uploadFile này đc định nghĩa ra để upload ảnh bản ghi nếu có
                $params['cols']['anh_danh_muc'] = $this->uploadFile($request->file('anh_danh_muc'));
            }
            $res =  $this->danh_muc->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_Admin_BE_Danh_Muc_Khoa_Hoc');
            } else {
                // thêm không thành công
                Session::flash('error', "Thêm không thành công");
                return redirect()->route('route_Admin_BE_Danh_Muc_Khoa_Hoc');
            }
        }

        return view('admin.danhmuc.add');
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
        $this->authorize(mb_strtoupper('edit danh mục khóa học'));

        if (!empty($id)) {
            $request->session()->put('id', $id);
            $result = $this->danh_muc->show($id);
            if ($result) {
                // hiển thị dữ liện vào form chỉnh sửa
                $this->v['detail'] = $result;
                return view('admin.danhmuc.update', $this->v);
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
    public function update(DanhMucRequest $request)
    {
        $this->authorize(mb_strtoupper('update danh mục khóa học'));

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
        // dd($params['cols']['ten_danh_muc']);
        // $check = $this->danh_muc->tendanhmuc($params['cols']['ten_danh_muc']);
        // dd($check);
        // if ($check) {
        //     // dd(1);
        //     Session::flash('mes', 'Ten danh muc da ton tai');
        //     return back();
        // }

        if ($request->file('anh_danh_muc')) {
            $params['cols']['anh_dahh_muc'] = $this->uploadFile($request->file('anh_danh_muc'));
        }
        // dd($params);
        $res  = $this->danh_muc->saveupdate($params);
        if ($res > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('route_Admin_BE_Danh_Muc_Khoa_Hoc');
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
        $this->authorize(mb_strtoupper('xóa danh mục khóa học'));
        // điều kiện xóa danh mục là danh mục này không có khóa học nào
        // $arrayIdKhoaHoc = [];
        // $listKhoaHoc =  $this->khoahoc->DanhSachKhoaHocTheoIDDanhMuc($id);
        // dd($listKhoaHoc);
        // 
        // if()

       
        $res = $this->danh_muc->remove($id);
        if ($res > 0) {
            // xóa danh mục thì cx cần xóa những khóa hoc liên quan
            $this->khoahoc->remove(null, $id);
            // khi xóa khoa học thì xóa lớp học liên quan đến khóa học đó

            // khi xóa lớp thì cần xóa những lớp đã có lịch học
            Session::flash('success', "Xóa thành công");
            return back();
        } else {
            Session::flash('error', 'Xóa không thành công');
            return back();
        }
    }


    // hàm upload file
    public function uploadFile($file)
    {
        $filename =  time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageDanhMuc', $filename,  'public');
    }


    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa danh mục khóa học'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['cols']['_token']);
            $res = $this->danh_muc->remoAll($params);


            if ($res > 0) {
                $this->khoahoc->remoAll(null, $params);
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }
}
