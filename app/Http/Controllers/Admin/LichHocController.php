<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lich;
use App\Models\Lop;
use App\Models\PhongHoc;
use App\Models\ThuHoc;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Svg\Tag\Rect;

class LichHocController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $v, $ca, $thu, $lich, $phong, $khoahoc, $lop, $giangvien ,$xeplop;
    public function __construct()
    {
        $this->v  = [];
        $this->ca = new CaHoc();
        $this->thu =  new ThuHoc();
        $this->lich = new Lich();
        $this->phong = new PhongHoc();
        $this->khoahoc = new KhoaHoc();
        $this->lop = new Lop();
        $this->giangvien = new GiangVien();
        $this->xeplop = new XepLop();
    }
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem lịch học') );
        // hiển thị ra danh sách lớp học 
        $this->v['params']  = $request->all();
       
        unset($this->v['params']['_token']);
        $this->v['list']  = $this->lop->index($this->v['params'] , true , 10);
        $this->v['xepLop'] = $this->xeplop->index(null , false , null);
        //  dd($this->v['list']);
        return view('admin.lich.listlop', $this->v);
        
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
        $this->authorize(mb_strtoupper('thêm lịch học') );

        $this->v['ca'] = $this->ca->index(null, false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['phong'] = $this->phong->index(null, false, null);
        $this->v['lop'] = $this->lop->index(null, false, null);

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
            // dd($params);
            $res = $this->lich->create($params);
            if ($res > 0) {
                Session::flash('success', "Thêm thành công");
            } else {
                Session::flash('error', "Thêm không thành công");
            }
            return redirect()->route('route_BE_Admin_List_Lich_Hoc');
        }
        return view('admin.lich.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , Request $request)
    {
        $this->authorize(mb_strtoupper('xem chi tiết lịch học') );

        // hiển thị lịch học của lớp học khi ấn vào lớp học đó 
        $this->v['params'] = $request->all();
        $this->v['params']['lop_id'] = $id;
        // dd($this->v['params']);
        $this->v['ca'] = $this->ca->index(null, false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['phong'] = $this->phong->index(null, false, null);
        $this->v['khoahoc'] = $this->khoahoc->index(null, false, null);
        $this->v['lop'] = $this->lop->index(null, false, null);
        $this->v['giangvien'] = $this->giangvien->index(null, false, null);
        $this->v['list'] = $this->lich->index($this->v['params'] , true , 10);
// dd(123);
        // dd($this->v['list']);    
        return view('admin.lich.index', $this->v);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->authorize(mb_strtoupper('edit lịch học') );

        if ($id) {
            $this->v['ca'] = $this->ca->index(null, false, null);
            $this->v['thu'] = $this->thu->index(null, false, null);
            $this->v['phong'] = $this->phong->index(null, false, null);
            $this->v['lop'] = $this->lop->index(null, false, null);
            $request->session()->put('id', $id);
            $res  = $this->lich->show($id);
            // dd($res);
            $this->v['res'] = $res;
            return view('admin.lich.update', $this->v);
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
        // dd($request->all());
        $this->authorize(mb_strtoupper('update lịch học') );
        
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
            // dd($params);
            // $params['cols']['id'] = session('id');
            $res = $this->lich->saveupdate($params);
            // dd($res);
            if ($res > 0) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Cập nhật không thành công'
                ]);
            }
            // return redirect()->route('route_BE_Admin_List_Lich_Hoc'); 
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(mb_strtoupper('xóa lịch học') );

        if ($id) {
            // dd($id);
            $res = $this->lich->remove($id);
            if ($res > 0) {
                Session::flash('success', 'Xóa thành công');
            } else {
                Session::flash('error', 'Xóa không thành công');
            }
            return back();
        }
    }


    public function destroyAll(Request $request){
        // dd($request->all);
        // $request  =  $request->all();
        // $this->authorize(mb_strtoupper('xóa khuyến mại') );
        $this->authorize(mb_strtoupper('xóa lịch học') );

        if($request->isMethod('POST')){
            $params = [];
            $params['cols'] = array_map(function($item){
                return $item;
            } , $request->all());
            unset($params['_token']);
            $res = $this->lich->remoAll($params);
            // dd($res);

            if($res > 0){
                Session::flash('success , "Xóa thành công');
                return back();
            }else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
          
        }
    }
}
