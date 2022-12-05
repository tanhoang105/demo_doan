<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GhiNo;
use App\Http\Requests\TaiKhoanRequest;
use App\Models\GiangVien;
use App\Models\HocVien;
use App\Models\Lop;
use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $v, $taikhoan, $vaitro, $hocvien, $giangvien,  $lop;

    public function __construct()
    {
        $this->v = [];
        $this->taikhoan = new User();
        $this->vaitro = new VaiTro();
        $this->hocvien = new HocVien();
        $this->giangvien = new GiangVien();
        $this->lop = new Lop();
    }

    public function index(Request $request)
    {

        $this->authorize(mb_strtoupper('xem tài khoản'));

        $this->v['params'] = $request->all();
        $this->v['vaitro'] = $this->vaitro->index(null, false, null);
        $this->v['lop'] = $this->lop->index(null, false, null);
        //phần lọc 
        $params = [];
        $params['loc'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());
        if($request->keyword){
            
            $params['loc']['keyword'] = $request->keyword;
            
        }
        $this->v['list'] = $this->taikhoan->index($params, true, 10);


        // phần ẩn nút xóa
        $arrayIdGiangVienCuaLop = [];
        foreach ($this->v['lop'] as $itemLop) {
            $arrayIdGiangVienCuaLop[] = $itemLop->id_giang_vien;
        }
        $arrayIdGiangVienCuaLop = array_unique($arrayIdGiangVienCuaLop);
        // dd($arrayIdGiangVienCuaLop);
        $this->v['arrayIdGiangVienCuaLop'] = $arrayIdGiangVienCuaLop;
        // $check = in_array(3 , $arrayIdGiangVienCuaLop);


        return view('admin.taikhoan.index', $this->v);
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
    public function store(TaiKhoanRequest $request)
    {
        // dd($request->all());
        // dd(Auth::user()->id);
        // $vaitro = User::find(Auth::user()->id)->role;
        // dd($vaitro->permissions);

        $this->authorize(mb_strtoupper('thêm tài khoản'));

        $this->v['vaitro'] = $this->vaitro->index(null, false, null);
        //        dd($this->v['vaitro']);
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
            if ($request->file('hinh_anh')) {
                // $checkanh = 1;
                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }
            //            dd($params['cols']);
            $res = $this->taikhoan->create($params);

            if ($res > 0) {
                // khi thêm tài khoản thì cx cần thêm vào bảng học viên hoặc bảng giảng viên ...
                $tk = $this->taikhoan->show($res);
                $vaitro = $this->vaitro->show($tk->vai_tro_id);
                if (!strcasecmp($vaitro->ten_vai_tro, 'học viên')) {
                    $this->hocvien->insert([
                        'user_id' => $res,
                        'ten_hoc_vien' => $params['cols']['name'],
                        'dia_chi' => $params['cols']['dia_chi'],
                        'email' => $params['cols']['email'],
                        'sdt' => $params['cols']['sdt'],
                        // 'hinh_anh' => $params['cols']['hinh_anh'],
                    ]);
                }
                if (!strcasecmp($vaitro->ten_vai_tro, 'giảng viên')) {
                    $this->giangvien->insert([
                        'id_user' => $res,
                        'ten_giang_vien' => $params['cols']['name'],
                        'dia_chi' => $params['cols']['dia_chi'],
                        'email' => $params['cols']['email'],
                        'sdt' => $params['cols']['sdt'],

                    ]);
                }
                // them tk ghi no
                $data = User::where('users.email', '=', $request->email)
                    ->get();

                // dd($data);
                foreach ($data as $value) {
                    $ghino = new GhiNo();
                    $ghino->user_id = $value->id;
                    $ghino->tien_no = 0;
                    $ghino->trang_thai = 0;
                    $ghino->save();
                }
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            }
        }

        return view('admin.taikhoan.add', $this->v);
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
    public function edit($id, Request $request)
    {
        // dd(123);
        $this->authorize(mb_strtoupper('edit tài khoản'));

        if ($id) {
            $request->session()->put('id', $id);
            $res = $this->taikhoan->show($id);
            $this->v['vaitro'] = $this->vaitro->index(null, false, null);

            if ($res) {
                $this->v['res'] = $res;
                //                dd($this->v['res']);
                return view('admin.taikhoan.update', $this->v);
            } else {
                Session::flash('error', "Lỗi không thể chỉnh sửa");
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
    public function update(TaiKhoanRequest $request)
    {
        $this->authorize(mb_strtoupper('update tài khoản'));

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

            $flag = null;
            if ($request->file('hinh_anh')) {
                $flag = 1;
                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            } else {
                unset($params['cols']['hinh_anh']);
            }

            if ($request->input('password')) {
                $params['cols']['password'] = Hash::make($params['cols']['password']);
            } else {
                unset($params['cols']['password']);
            }
            //            dd($params['cols']);
            $tkCurrent = $this->taikhoan->show($id);
            // dd($tkCurrent);
            // $tkCurrent->id
            $res = $this->taikhoan->saveupdate($params);
            if ($res > 0) {
                // if($)
                if ($tkCurrent->vai_tro_id == 2) {
                    // giảng viên 
                    if ($flag == 1) {
                        GiangVien::where('id_user', $id)->update([

                            'ten_giang_vien' => $params['cols']['name'],
                            'dia_chi' => $params['cols']['dia_chi'],
                            'email' => $params['cols']['email'],
                            'sdt' => $params['cols']['sdt'],
                            'hinh_anh' => $params['cols']['hinh_anh'],
                        ]);
                    } else {
                        GiangVien::where('id_user', $id)->update([

                            'ten_giang_vien' => $params['cols']['name'],
                            'dia_chi' => $params['cols']['dia_chi'],
                            'email' => $params['cols']['email'],
                            'sdt' => $params['cols']['sdt'],
                        ]);
                    }
                }
                if ($tkCurrent->vai_tro_id == 4) {
                    // học viên 
                    if ($flag == 1) {
                        HocVien::where('user_id', $id)->update([
                            'user_id' => $id,
                            'ten_hoc_vien' => $params['cols']['name'],
                            'dia_chi' => $params['cols']['dia_chi'],
                            'email' => $params['cols']['email'],
                            'sdt' => $params['cols']['sdt'],
                            'hinh_anh' => $params['cols']['hinh_anh'],
                        ]);
                    } else {


                        HocVien::where('user_id', $id)->update([
                            'user_id' => $id,
                            'ten_hoc_vien' => $params['cols']['name'],
                            'dia_chi' => $params['cols']['dia_chi'],
                            'email' => $params['cols']['email'],
                            'sdt' => $params['cols']['sdt'],
                        ]);
                    }
                }
                Session::flash('success', 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_Tai_Khoan');
            } else {
                Session::flash('error', 'Cập nhập không thành công');
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
        $this->authorize(mb_strtoupper('xóa tài khoản'));

        if ($id) {
            $res = $this->taikhoan->remove($id);
            // tìm học viên tương ứng 

            if ($res > 0) {

                // xóa những học viên giảng viên tương ứng
                $this->hocvien->remove($id);
                $this->giangvien->remove($id);
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công');
                return back();
            }
        }
    }

    public  function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageTaiKhoan', $filename,  'public');
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa tài khoản'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->taikhoan->remoAll($params);
            // dd($res);

            if ($res > 0) {
                // khi xóa tài khoản thành công thì xóa những học viên và giảng viên tương ứng 
                $this->hocvien->remoAll($params);
                $this->giangvien->remoAll($params);
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }
}
