<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiangVien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GiangVienController extends Controller
{

    protected $v , $giangvien , $user ;

    public function __construct()
    {
        $this->v = [];
        $this->giangvien =  new GiangVien();
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $this->v['list'] = $this->giangvien->index($this->v['params'] , true , 5);
        // dd($this->v['list']);
        return view('admin.giangvien.index' , $this->v);
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
    {
        if($id){

            $res = $this->giangvien->remove($id);
           // khi xóa tài khoản ở bảng giáo viên thì cần xóa luôn ở bảng user
            
        //    dd($id_user , 123);

            if($res){
                Session::flash('success' ,"Xóa thành công");
                $this->user->remove($id);
                return back();
            }else {
                Session::flash('error' ,"Xóa không thành công");
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
            $res = $this->giangvien->remoAll($params);
            // dd($res);

            if($res > 0){
                // khi xóa thành công những giảng viên này thì cần xóa những user có id tương ứng 
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
