<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    protected $v;
    protected $banner;

    public function __construct()
    {
        $this->v = [];
        $this->banner = new Banner();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['pramas'] = $request->all();
        $list = $this->banner->index($this->v, true, 5);
        $this->v['list'] = $list;
        return view('Admin.banner.index', $this->v);
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
    public function store(BannerRequest $request)
    {
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
            if ($request->file('anh_banner')) {
                // hàm uploadFile này đc định nghĩa ra để upload ảnh bản ghi nếu có
                $params['cols']['anh_banner'] = $this->uploadFile($request->file('anh_banner'));
            }
            $res =  $this->banner->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', "Thêm thành công");
                return redirect()->route('route_BE_Admin_Banner');
            } else {
                // thêm không thành công
                Session::flash('error', "Thêm không thành công");
                return redirect()->route('route_BE_Admin_Banner');
            }
        }

        return view('admin.banner.add');
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
        // lấy ra dữ liệu bản ghi cần chỉnh sửa
        if (!empty($id)) {
            $this->v['params'] = $request->all();

            $request->session()->put('id', $id);
            $banner = $this->banner->show($id);
            $this->v['banner'] = $banner;
            return view('admin.banner.update', $this->v);
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
    public function update(BannerRequest $request)
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
        if ($request->file('anh_banner')) {
            $params['cols']['anh_banner'] = $this->uploadFile($request->file('anh_banner'));
        }
        // dd($params);
        $res  = $this->banner->saveupdate($params);
        if ($res > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('route_BE_Admin_Banner');
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
        $res = $this->banner->remove($id);
        if ($res > 0) {
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
        return $file->storeAs('imageBanner', $filename,  'public');
    }
}
