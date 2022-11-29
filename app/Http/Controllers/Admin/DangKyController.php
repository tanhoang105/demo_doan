<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\DangKy;
use App\Models\HocVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\PhuongThucThanhToan;
use App\Models\ThanhToan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;

class DangKyController extends Controller
{
    protected $v, $dangky, $lop, $khoahoc, $phuongthucthanhtoan;

    public function __construct()
    {
        $this->v = [];
        $this->dangky = new DangKy();
        $this->lop = new Lop();
        $this->khoahoc = new KhoaHoc();
        $this->phuongthucthanhtoan = new PhuongThucThanhToan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem đăng ký') );

        $this->v['params'] = $request->all();
        $this->v['list'] = $this->dangky->index($this->v['params'], true, 10);

        // dd($this->v['list']);
        return view('admin.dangky.index', $this->v);
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
    public function listDangKy(Request $request){
        $objDangKy=new DangKy();
        $listLop=$objDangKy->listLopofKhoaHoc($request->id_khoa_hoc);
        $objKhoaHoc=new KhoaHoc();
        $gia_khoa_hoc=$objKhoaHoc->show($request->id_khoa_hoc);
<<<<<<< HEAD
        // dd($gia_khoa_hoc);
=======
>>>>>>> 4c4e60db828f6b720f38e6efa3d96861a2390e93
        return response()->json(['success'=>true ,'lop'=>$listLop , 'gia_khoa_hoc'=>$gia_khoa_hoc->gia_khoa_hoc] );
    }

    public function store(Request $request)
    {

        $this->authorize(mb_strtoupper('thêm đăng ký') );

        $lop = $this->lop->index(null, false, null);
        $this->v['lop'] =  $lop;

//        dd($request->all());
                $objDangKy = new DangKy();
            if ($request->isMethod('post')) {
                $loadDangKy = $objDangKy->listDangky($request->id_lop);
                if ($loadDangKy->so_luong > 0) {
                $objHocvien = new HocVien();
                $objDangKy = new DangKy();
                $params = $request->post();
                $params['cols'] = array_map(function ($item) {
                    if ($item == '')
                        $item = null;
                    if (is_string($item))
                        $item = trim($item); // lọc trước khi gửi đi
                    return $item;
                },
                    $request->post());
                unset($params['cols']['_token']);
                // dd($params['cols']);
                //kiểm tra nếu chưa có tài khoản
                $password = Str::random(8);
                $dataUser = $params;
//                dd($dataUser, $params['cols']);
                $dataUser['cols']['password'] = Hash::make($password);
                unset($dataUser['cols']['id_khoa_hoc']);
                unset($dataUser['cols']['id_lop']);
                unset($dataUser['cols']['gia_khoa_hoc']);
//                dd($password,$params['cols']['password']);
                $modelTest = new User();
                $res = $modelTest->saveNew($dataUser);
                // thêm học viên
                if ($res > 0) {
                    $dataHocVien = $params;
                    unset($dataHocVien['cols']['name']);
                    $dataHocVien['cols']['ten_hoc_vien'] = $request->name;
                    $dataHocVien['cols']['user_id'] = $res;
                    unset($dataHocVien['cols']['id_khoa_hoc']);
                    unset($dataHocVien['cols']['id_lop']);
                    unset($dataHocVien['cols']['gia_khoa_hoc']);
                    $saveNewHocVien = $objHocvien->saveNew($dataHocVien);
                    $objThanhToan=new ThanhToan();
                    $inserThanhToan=$objThanhToan->saveNew([

                        'id_phuong_thuc_thanh_toan'=>1,
                        'ngay_thanh_toan'=>date('Y-m-d'),
                        'gia'=>$request->gia_khoa_hoc,
                    ]);
                    if ($saveNewHocVien > 0 && $inserThanhToan>0) {

                        $data = [
                            'ngay_dang_ky' => date('Y-m-d'),
                            'id_lop' => $request->id_lop,
                            'id_user' => $res,
                            'gia' => $request->gia_khoa_hoc,
                            'id_thanh_toan'=>$inserThanhToan,
                        ];
                        $objDangKy->saveNew($data);
                        Session::flash('success', 'Đăng ký Khóa học thành công');

                        // dd($params['cols']['email']);
                        Mail::to($params['cols']['email'])->send(new SendMail([
                            'password'=>$password,
                            'message' => 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi']));
                    }
                } else {
                    Session::flash('error', 'Lỗi đăng ký');
                }
            }
//            $this->v['listthanhtoan'] = $this->phuongthucthanhtoan->index(null, false, null);



        }
                $objKhoaHoc = new KhoaHoc();
                $listKhoaHoc = $objKhoaHoc->index(null, false, null);

        return view('admin.dangky.add', $this->v, compact('listKhoaHoc'));
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
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa đăng ký') );

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->dangky->remoAll($params);
            // dd($res);

            if ($res > 0) {
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }
}
