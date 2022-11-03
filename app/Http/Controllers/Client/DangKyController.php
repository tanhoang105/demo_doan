<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\DangKy;
use App\Models\HocVien;
use App\Models\KhachHang;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class DangKyController extends Controller
{
    //
    public function loadDangKy(Request $request){

        $objKhoaHoc=new KhoaHoc();
        $params=$request->all();
        $listKhoaHoc=$objKhoaHoc->index($params , false , '');

        // kiểm tra nếu có khóa học gửi từ ajax
        if (!empty($request->id_khoahoc)){
            $detail = KhoaHoc::find($request->id_khoahoc);
            $objLop=new Lop();
            $listLop=$objLop->LoadLopofKhoaHoc($request->id_khoahoc);
            return response()->json(['success'=>true,'lop'=>$listLop ,'gia_khoa_hoc'=>$detail->gia_khoa_hoc]);
        }
        if (!empty($request->id_khoa_hoc) && !empty($request->id_lop) && !empty($request->gia_khoa_hoc)){
            $objLop=new Lop();
            $idLop=$request->id_lop;
            $idKhoaHoc=$request->id_khoa_hoc;
            $giaKhoaHoc=$request->gia_khoa_hoc;
            $listLop=$objLop->LoadLopofKhoaHoc($request->id_khoa_hoc);
            return view('client.khoa-hoc.dang-ky-khoa-hoc',compact('listLop','listKhoaHoc','idLop','idKhoaHoc','giaKhoaHoc'));
        }

        return view('client.khoa-hoc.dang-ky-khoa-hoc',compact('listKhoaHoc'));
    }
    public function postDangKy(Request $request){
//        dd($request->all());
//        try {
//            DB::beginTransaction();
            if($request->isMethod('post')){
                $objHocvien=new HocVien();
                $objDangKy=new DangKy();
                $params=$request->post();
                $params['cols']= array_map(function($item){
                    if($item=='')
                        $item=null;
                    if(is_string($item))
                        $item=trim($item); // lọc trước khi gửi đi
                    return $item;
                },
                    $request->post());
                unset($params['cols']['_token']);
                // dd($params['cols']);
                // kiểm tra nếu chưa có tài khoản
                if (empty($request->id_user)){
                    $password=Str::random(8);
                    $dataUser=$params;
                    $dataUser['cols']['password']=Hash::make($password);
                    unset($dataUser['cols']['user_id']);
                    unset($dataUser['cols']['id_khoa_hoc']);
                    unset($dataUser['cols']['id_lop']);
                    unset($dataUser['cols']['gia_khoa_hoc']);
//                dd($password,$params['cols']['password']);
                    $modelTest=new User();
                    $res=$modelTest->saveNew($dataUser);
                    // thêm học viên
                    if($res>0){
                        $dataHocVien=$params;
                        unset($dataHocVien['cols']['name']);
                        $dataHocVien['cols']['ten_hoc_vien']=$request->name;
                        $dataHocVien['cols']['user_id']=$res;
                        unset($dataHocVien['cols']['id_khoa_hoc']);
                        unset($dataHocVien['cols']['id_lop']);
                        unset($dataHocVien['cols']['gia_khoa_hoc']);
                        $saveNewHocVien=$objHocvien->saveNew($dataHocVien);
                        if ($saveNewHocVien>0){

                            $data=[
                                'ngay_dang_ky'=>date('Y-m-d'),
                                'id_lop'=>$request->id_lop,
                                'id_user'=>$res,
                                'gia'=>$request->gia_khoa_hoc,
                            ];
                            $objDangKy->saveNew($data);
                            Session::flash('success','Đăng ký Khóa học thành công');
                            
                            // dd($params['cols']['email']);
                            Mail::to($params['cols']['email'])->send(new SendMail(['message'=> 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi']));
                        }
                    }
                    else{
                        Session::flash('error','Lỗi đăng ký');
                    }
                }
                else{
                    $objHocvien=new HocVien();
                    $query=$objHocvien->getHocVien($request->id_user);
                    // kiểm tra user đăng nhập đã là học viên
                    if ($query->count()>0){
                        $objDangKy=new DangKy();
                        $data=[
                            'ngay_dang_ky'=>date('Y-m-d H:i:s'),
                            'id_lop'=>$request->id_lop,
                            'id_user'=>$request->id_user,
                        ];
                        $objDangKy->saveNew($data);

                    }
                    else{
                        // kiểm tra user đăng nhập không là học viên
                        unset($params['cols']['name']);
                        $params['cols']['ten_hoc_vien']=$request->name;
                        $saveNewHocVien=$objHocvien->saveNew($params);
                        if ($saveNewHocVien>0){
                            $objDangKy=new DangKy();
                            $data=[
                                'ngay_dang_ky'=>date('Y-m-d H:i:s'),
                                'id_lop'=>$request->id_lop,
                                'id_user'=>$request->id_user,
                            ];
                            $dangKy=$objDangKy->saveNew($data);
                        }
                    }
                }


            }

            return redirect()->route('client_dang_ky');

//        }
//        catch (\Throwable $th) {
//            //throw $th;
//            DB::rollBack();
//            return redirect()->route('dangkyCourse',['id'=>$id]);
//        }
    }
}
