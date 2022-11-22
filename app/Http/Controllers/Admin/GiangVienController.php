<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\LichHoc;
use App\Models\Lop;
use App\Models\PhongHoc;
use App\Models\ThuHoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GiangVienController extends Controller
{

    protected $v, $giangvien, $user , $lichday;

    public function __construct()
    {
        $this->v = [];
        $this->giangvien =  new GiangVien();
        $this->user = new User();
        $this->lichday = new LichHoc();

     
        $this->thuhoc = new ThuHoc();
        $this->phonghoc = new PhongHoc();
        $this->khoahoc = new KhoaHoc();
        $this->lop = new Lop();
        $this->giang_vien = new GiangVien();
        $this->ca_hoc = new CaHoc();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem giảng viên'));

        $this->v['params'] = $request->all();
        $this->v['list'] = $this->giangvien->index($this->v['params'], true, 5);
        // dd($this->v['list']);
        return view('admin.giangvien.index', $this->v);
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
            // thực hiện thêm dữ liệu
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
            $params['cols']['vai_tro_id'] = 2;
            $params['cols']['hinh_anh'] = null;
            // dd($params);
            if ($request->file('hinh_anh')) {

                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }
            //            dd($params['cols']);
            $res = $this->user->create($params);

            if ($res > 0) {

                $this->giangvien->insert([
                    'id_user' => $res,
                    'ten_giang_vien' => $params['cols']['name'],
                    'dia_chi' => $params['cols']['dia_chi'],
                    'email' => $params['cols']['email'],
                    'sdt' => $params['cols']['sdt'],
                    'hinh_anh' => $params['cols']['hinh_anh'],
                ]);



                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_List_Giang_Vien');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_List_Giang_Vien');
            }
        }
        return view('admin.giangvien.add');
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
            $res = $this->giangvien->show($id);
            $this->v['res'] = $res;
            // dd($this->v['res']);
            return view('admin.giangvien.update', $this->v);
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
            //            dd($id);
            unset($params['cols']['_token']);
            $params['cols']['id'] = $id;
            $params['cols']['hinh_anh'] = null;
            if ($request->file('hinh_anh')) {

                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }

            if ($request->input('password')) {
                $params['cols']['password'] = Hash::make($params['cols']['password']);
            } else {
                unset($params['cols']['password']);
            }

            //    dd($params['cols']);
            $res = $this->user->saveupdate($params);

            if ($res > 0) {
                GiangVien::where('id_user', $id)->update([
                    // 'id_user' => $id,
                    'ten_giang_vien' => $params['cols']['name'],
                    'dia_chi' => $params['cols']['dia_chi'],
                    'email' => $params['cols']['email'],
                    'sdt' => $params['cols']['sdt'],
                    'hinh_anh' => $params['cols']['hinh_anh'],
                ]);

                Session::flash('success', 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_List_Giang_Vien');
            } else {
                Session::flash('error', 'Cập nhập không thành công');
                return redirect()->route('route_BE_Admin_List_Giang_Vien');
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

        $this->authorize(mb_strtoupper('xóa giảng viên'));

        if ($id) {

            $res = $this->giangvien->remove($id);
            // khi xóa tài khoản ở bảng giáo viên thì cần xóa luôn ở bảng user

            //    dd($id_user , 123);

            if ($res) {
                Session::flash('success', "Xóa thành công");
                $this->user->remove($id);
                return back();
            } else {
                Session::flash('error', "Xóa không thành công");
                return back();
            }
        }
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa giảng viên'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->giangvien->remoAll($params);
            // dd($res);

            if ($res > 0) {
                // khi xóa thành công những giảng viên này thì cần xóa những user có id tương ứng 
                $this->user->remoAll($params);
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }


    public function lichDay()
    {
        $id = Auth::user()->id;
        $params['id'] = $id;
        $listThuHoc = $this->thuhoc->index(null, false, null);
        $this->v['thuhoc'] = $listThuHoc;
        $this->v['phonghoc'] = $this->phonghoc->index(null, false, null);
        $this->v['khoa_hoc'] = $this->khoahoc->index(null  , false , null);
        $this->v['lop'] = $this->lop->index(null , false , null);
        $this->v['giang_vien'] = $this->giang_vien->index(null , false , null);
        $this->v['ca_hoc'] = $this->ca_hoc->index(null , false , null);

        $res  = $this->lichday->showLichGiaoVien($params ,false  , null);
       
        $array = [];
        foreach($res as $item){
            if($item->ngay_hoc > date('Y-m-d')){
                $array[] = $item;
            }
        }
        $this->v['list']   = $array ;
        return view('admin.lichday.index' , $this->v );
    }
}
