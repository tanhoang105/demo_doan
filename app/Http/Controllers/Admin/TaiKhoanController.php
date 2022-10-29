<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $v, $taikhoan;

    public function __construct()
    {
        $this->v = [];
        $this->taikhoan = new User();
    }

    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $this->v['list'] = $this->taikhoan->index($this->v['params'], true, 4);
//        dd($this->v['list']);

        return view('admin.taikhoan.index' ,$this->v);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            // thực hiện thêm dữ liệu
            $params = [];
            $params['cols'] = array_map(function ($item){
                if($item == '') {
                    $item = null ;
                }

                if(is_string($item)){
                    $item = trim($item);
                }
                return $item;
            } , $request->post());
            unset($params['cols']['_token']);
            if($request->file('hinh_anh')){
                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }
//            dd($params['cols']);
            $res = $this->taikhoan->create($params);
            if($res > 0){
                Session::flash('success' , 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            }else {
                Session::flash('error' , 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');

            }
        }

        return view('admin.taikhoan.add');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
        if($id){
            $request->session()->put('id' ,$id);
            $res = $this->taikhoan->show($id);

            if($res){
                $this->v['res'] = $res ;
//                dd($this->v['res']);
                return view('admin.taikhoan.update', $this->v);
            }else {
                Session::flash('error' , "Lỗi không thể chỉnh sửa");
                return back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(session('id')) {
            $id = session('id');
            $params = [];
            $params['cols'] = array_map(function ($item) {
                if($item == '') {
                    $item = null;
                }
                if(is_string($item)){
                    $item = trim($item);
                }
                return $item;
            }  , $request->post());
//            dd($id);
            unset($params['cols']['_token']);
            $params['cols']['id'] = $id;
            if($request->file('hinh_anh')){

                $params['cols']['hinh_anh']= $this->uploadFile($request->file('hinh_anh'));
            }

            if ($request->input('password')) {
                $params['cols']['password'] = Hash::make($params['cols']['password']);

            } else {
                unset($params['cols']['password']);
            }
            dd($params['cols']);
            $res = $this->taikhoan->saveupdate($params);
            if($res > 0){
                Session::flash('success' , 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            }else {
                Session::flash('error' , 'Cập nhập không thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($id){
            $res = $this->taikhoan->remove($id);
            if($res > 0) {
                Session::flash('success' , 'Xóa thành công');
                return back();
            }else {
                Session::flash('error' , 'Xóa không thành công');
                return back();
            }
        }
    }

    public  function uploadFile($file){
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageTaiKhoan', $filename,  'public');
    }
}
