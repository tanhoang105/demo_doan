<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HocVien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HocVienController extends Controller
{

    protected $v, $hocvien , $user ;
    public function __construct()
    {
        $this->v  = [];
        $this->hocvien = new HocVien();
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        $this->v['params'] = $request->all();
        $this->v['list'] = $this->hocvien->index($this->v['params'] , true , 10);
        // dd($this->v['list']);
        return view('admin.hocvien.index' , $this->v);
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
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    // id học viên xóa
    {
        // xóa học viên trong bảng học viên thì xóa luôn trong bảng user
        if($id){
            
            $res = $this->hocvien->remove($id);
          
            // dd($id_user);
            // xóa học viên xóa => users
            if($res > 0){
                $this->user->remove($id);
                Session::flash('success' , 'Xóa thành công ');
                return back();
            }else {
                Session::flash('error' , 'Xóa không thành công ');
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
            $res = $this->hocvien->remoAll($params);
            // dd($res);

            if($res > 0){
                // khi xóa thành công những học viên này thì cần xóa những user có id tương ứng với user_id học viên
                $this->user->remoAll($params);
                Session::flash('success , "Xóa thành công');
                return back();
            }else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
          
        }
    }

   
}
