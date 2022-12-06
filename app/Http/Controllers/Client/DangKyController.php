<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\DangKyRequest;
use App\Mail\SendMail;
use App\Models\DangKy;
use App\Models\HocVien;
use App\Models\KhachHang;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\Order;
use App\Models\GhiNo;
use App\Models\ThanhToan;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class DangKyController extends Controller
{
    //
    public function loadDangKy($id){
        $objDangKy=new DangKy();
        $loadDangKy=$objDangKy->listDangky($id);
        // dd($loadDangKy);
        $ca_thu_id=explode(',',$loadDangKy->thu_hoc_id);
        $layThu=$objDangKy->layThu($ca_thu_id);
        $payment_method = DB::table('phuong_thuc_thanh_toan')
            ->get();
        // dd($layThu);
        return view('client.khoa-hoc.dang-ky-khoa-hoc',compact('loadDangKy','payment_method','layThu'));
    }
    public function postDangKy(DangKyRequest $request ,$id)
    {
//        try {
//            DB::beginTransaction();
        $objDangKy = new DangKy();
        $loadDangKy = $objDangKy->listDangky($id);
        $ca_thu_id=explode(',',$loadDangKy->thu_hoc_id);
        $layThu=$objDangKy->layThu($ca_thu_id);

        if ($loadDangKy->so_luong > 0) {
            if ($request->isMethod('post')) {
                $objHocvien = new HocVien();
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
                unset($params['cols']['id_khoa_hoc']);
                unset($params['cols']['ca_id']);
                unset($params['cols']['thu_hoc_id']);
                unset($params['cols']['khuyen_mai_id']);
                unset($params['cols']['gia_khoa_hoc_payment']);
                unset($params['cols']['id']);
                unset($params['cols']['lop_id']);
                // dd($params['cols']);
                // kiểm tra nếu chưa có tài khoản
                if (empty(Auth::user())) {
                    // dd(123);
                    $password = Str::random(8); 
                    $dataUser = $params;
                    $dataUser['cols']['vai_tro_id']= 4;
                    $dataUser['cols']['password'] = Hash::make($password);
                    unset($dataUser['cols']['user_id']);
                    unset($dataUser['cols']['ten']);
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
                        unset($dataHocVien['cols']['ten']);
                        unset($dataHocVien['cols']['gia_khoa_hoc']);
                        $saveNewHocVien = $objHocvien->saveNew($dataHocVien);

                        $data = User::where('users.email','=',$request->email)
                        ->get();

                        // dd($data);
                        foreach($data as $value){
                            $ghino = new GhiNo();
                            $ghino->user_id = $value->id;
                            $ghino->tien_no = 0;
                            $ghino->trang_thai = 0;
                            $ghino->save();
                        }

                        $objThanhToan = new ThanhToan();
                        if ($request->ten == 1) {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'gia' => $request->gia_khoa_hoc,
                            ];
                        } else {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'ngay_thanh_toan' => date('Y-m-d H:i:s'),
                                'gia' => $request->gia_khoa_hoc,
                                'mo_ta' => 'quá nhanh',
                            ];
                        }
                        $insertThanhToan = $objThanhToan->saveNew($dataThanhToan);

                        if (!empty($insertThanhToan) > 0) {
                            
                           // $objDangKy = new DangKy();

                            $data = [
                                'ngay_dang_ky' => date('Y-m-d H:i:s'),
                                'id_lop' => $request->lop_id,
                                'id_user' => $res,
                                'gia' => $request->gia_khoa_hoc,
                                'id_thanh_toan' => $insertThanhToan,
                                'email' => $request->email,
                            ];
                            $resDK = $objDangKy->saveNew($data);
                            if ($resDK == null) {
                                redirect()->route('client_dang_ky', ['id' => $request->id]);
                            } elseif ($resDK > 0) {
                                if(!empty($request->khuyen_mai_id)) {
                                    $km = DB::table('khuyen_mai_user_da_dung')->insertGetId([
                                        'id_user' => $res,
                                        'khuyen_mai_id' => $request->khuyen_mai_id
                                    ]);
                                }
                                Mail::to($params['cols']['email'])->send(new SendMail([
                                    'user'=>$params['cols'],
                                    'dangky'=>$loadDangKy,
                                    'password'=>$password,
                                    'thuhoc'=>$layThu,
                                    'message' => 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi']));
                                if($request->ten == 2) {
                                    return response()->json([
                                        'msg' => 'Chưa đăng nhập',
                                        'id_dang_ky' => $resDK,
                                        'gia_khoa_hoc' => $request->gia_khoa_hoc,
                                        'success'=>true
                                    ]);
                                }
                               
                                return redirect()->route('client_complete_dang_ky', ['code' => $resDK]);
                            } else {
                                if($request->ten == 2) {
                                    return response()->json([
                                        'success'=>false
                                    ]);
                                }
                                Session::flash('error', 'Lỗi đăng ký khóa học');
                                redirect()->route('client_dang_ky', ['id' => $request->id]);
                            }


                        }
                    } else {
                        Session::flash('error', 'Lỗi đăng ký');
                    }
                }
                // Đã có tài khoản
                else {
                    $query=DB::table('dang_ky')
                    ->join('users','users.id','=','dang_ky.id_user')
                    ->join('lop','lop.id','=','dang_ky.id_lop')
                    ->join('khoa_hoc','khoa_hoc.id','=','lop.id_khoa_hoc')
                    ->where('lop.id_khoa_hoc',$request->id_khoa_hoc)
                    ->where('users.id',Auth::user()->id)
                    // ->andWhere('')
                    ->first();
                    if(empty($query)) {

                        $user = Auth::user();
                        dd($request->all());
                        $caHoc = DB::table('dang_ky')
                                ->join('lop','lop.id','=','dang_ky.id_lop')
                                ->join('ca_thu','ca_thu.id','=','lop.ca_thu_id')
                                ->where('dang_ky.id_user',$user->id)
                                ->select('lop.ca_thu_id','ca_thu.ca_id','ca_thu.thu_hoc_id')
                                ->get();
                        foreach ($caHoc as $item) {
                            if($request->ca_id == $item->ca_id  && $request->thu_hoc_id == $item->thu_hoc_id ) {
                                Session::flash('error', 'Ca học đã trùng với khóa học đã đăng ký');
                                return redirect()->route('client_dang_ky', ['id' => $request->id]);
                            }
                        }

                        $objHocvien = new HocVien();
                        $query = $objHocvien->getHocVien($request->user_id);
                        $objThanhToan = new ThanhToan();
                        if ($request->ten == 1) {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'gia' => $request->gia_khoa_hoc,
                            ];
                        } else {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'ngay_thanh_toan' => date('Y-m-d H:i:s'),
                                'gia' => $request->gia_khoa_hoc,
                                'mo_ta' => 'Thanh toán khóa học online',
                            ];
                        }
                        $insertThanhToan = $objThanhToan->saveNew($dataThanhToan);
                    // }
                    // kiểm tra user đăng nhập đã là học viên
//                    dd($query);
                    if (!empty($query->user_id) > 0) {
                            // ->where('user_id',$user->id)
                            if (!empty($insertThanhToan) > 0) {
                                $data = [
                                    'ngay_dang_ky' => date('Y-m-d H:i:s'),
                                    'id_lop' => $request->lop_id,
                                    'id_user' => $request->user_id,
                                    'gia' => $request->gia_khoa_hoc,
                                    'id_thanh_toan' => $insertThanhToan,
                                    'email' => $request->email,
                                ];
                                $res = $objDangKy->saveNew($data);

                            }
                            if ($res == null) {
                                redirect()->route('client_dang_ky', ['id' => $request->id]);
                            } elseif ($res > 0) {

                                if(!empty($request->khuyen_mai_id)) {
                                    $km = DB::table('khuyen_mai_user_da_dung')->insertGetId([
                                        'id_user' => Auth::user()->id,
                                        'khuyen_mai_id' => $request->khuyen_mai_id
                                    ]);
                                }
                                Mail::to($params['cols']['email'])->send(new SendMail([
                                    'user'=>$params['cols'],
                                    'dangky'=>$loadDangKy,
                                    'thuhoc'=>$layThu,
                                    'message' => 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi']));

                                if($request->ten == 2) {
                                    return response()->json([
                                        'msg' => 'đã đăng nhập',
                                        'id_dang_ky' => $res,
                                        'gia_khoa_hoc' => $request->gia_khoa_hoc,
                                        'success'=>true
                                    ]);
                                }
                                
                                return redirect()->route('client_complete_dang_ky', ['code' => $res]);

                            } else {
                                if($request->ten == 2) {
                                    return response()->json([
                                        'success'=>false
                                    ]);
                                }
                                Session::flash('error', 'Lỗi đăng ký khóa học');
                                return redirect()->route('client_dang_ky', ['id' => $request->id]);
                            }
                        

                    }
                    else {
                    //    dd(2);
                        // kiểm tra user đăng nhập không là học viên
                        $params['cols']['ten_hoc_vien'] = $request->name;
                        $dataHocVien = $params;
//                        dd($dataHocVien);
                        unset($dataHocVien['cols']['lop_id']);
                        unset($dataHocVien['cols']['ten']);
                        unset($dataHocVien['cols']['name']);
                        unset($dataHocVien['cols']['gia_khoa_hoc']);

                        $saveNewHocVien = $objHocvien->saveNew($dataHocVien);

                        $objThanhToan = new ThanhToan();
                        if ($request->ten == 1) {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'gia' => $request->gia_khoa_hoc,
                            ];
                        } else {
                            $dataThanhToan = [
                                'id_phuong_thuc_thanh_toan' => $request->ten,
                                'ngay_thanh_toan' => date('Y-m-d H:i:s'),
                                'gia' => $request->gia_khoa_hoc,
                                'mo_ta' => 'quá nhanh',
                            ];
                        }
                        $insertThanhToan = $objThanhToan->saveNew($dataThanhToan);
                        if ($saveNewHocVien > 0) {
                            // $objDangKy = new DangKy();
                            $data = [
                                'ngay_dang_ky' => date('Y-m-d H:i:s'),
                                'id_lop' => $request->lop_id,
                                'id_user' => $request->user_id,
                                'gia' => $request->gia_khoa_hoc,
                                'id_thanh_toan' => $insertThanhToan,
                                'email' => $request->email,
                            ];
                            $res = $objDangKy->saveNew($data);
                            if ($res == null) {
                                redirect()->route('client_dang_ky', ['id' => $request->id]);
                            } elseif ($res > 0) {
                                if(!empty($request->khuyen_mai_id)) {
                                    $km = DB::table('khuyen_mai_user_da_dung')->insertGetId([
                                        'id_user' => Auth::user()->id,
                                        'khuyen_mai_id' => $request->khuyen_mai_id
                                    ]);
                                }
                                Mail::to($params['cols']['email'])->send(new SendMail([
                                    'user'=>$params['cols'],
                                    'dangky'=>$loadDangKy,
                                    'thuhoc'=>$layThu,
                                    'message' => 'Xin chào bạn , Bạn vừa đăng ký thành công khóa học của chúng tôi']));
                                if($request->ten == 2) {
                                    return response()->json([
                                        'id_dang_ky' => $res,
                                        'gia_khoa_hoc' => $request->gia_khoa_hoc,
                                        'success'=>true,
                                    ]);
                                }
                                
                                Session::flash('success', 'Đăng ký Khóa học thành công');
                                DB::commit();
                                return redirect()->route('client_complete_dang_ky', ['code' => $res]);
                            } else {
                                Session::flash('error', 'Lỗi đăng ký khóa học');
                                redirect()->route('client_dang_ky', ['id' => $request->id]);
                            }
                        }
                    }

                }else {
                    if($request->ten == 2) {
                        return response()->json([
                            'success'=>false
                        ]);
                    }
                    Session::flash('error', 'Bạn đã đăng ký khóa học này !');
                    return  redirect()->route('client_dang_ky', ['id' => $request->id]);
                }

                }

            } else {
                if($request->ten == 2) {
                    return response()->json([
                        'success'=>false
                    ]);
                }
                Session::flash('success', 'Lớp đã đầy Không thể đăng ký');
                redirect()->route('client_dang_ky', ['id' => $request->id]);
            }
//        }
//        catch (\Throwable $th) {
//            //throw $th;
//            DB::rollBack();
//            return redirect()->route('dangkyCourse',['id'=>$id]);
//        }

        }
    }
    // đăng ký thành công
    public function completeDangKy($code){
        $objDangKy=new DangKy();
        $complete=$objDangKy->completeDangKy($code);
        return view('client.khoa-hoc.hoan-thanh-dang-ky',compact('complete'));
    }

    // lịch sử đăng ký
    public function lichsuDangKy($id){
        $obj=new DangKy();
        $list=$obj->lichsu($id);
        return view('client.dang-ky.lich-su-dang-ky',compact('list'));
    }

    //hàm checkemail
    public function checkEmail(Request $request){
        $obj=new User();
        // dd(Auth::user());
        if(!empty(Auth::user()) && Auth::user()->id > 0){
            $emailUser = Auth::user()->email;
            if($request->email != $emailUser) {
                $query=DB::table('users')
                ->where('email',$request->email)
                ->first();

                if (!empty($query)){
                    return response()->json(['message'=>'error','status'=>500]);
                } else{
                    return response()->json(['message'=>'success','status'=>200]);
                }
            }else{
                return response()->json(['message'=>'success','status'=>200]);
            }
        }
        else{
            $query=DB::table('users')
            ->where('email',$request->email)
            ->first();
            if (!empty($query)){
                return response()->json(['message'=>'error','status'=>500]);
            }
            else{
                return response()->json(['message'=>'success','status'=>200]);
            }
        }
       
    }

}
