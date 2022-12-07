<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhuyenmaiRequest;
use App\Models\KhuyenMai;
use App\Models\KhoaHoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Termwind\render;

class KhuyenMaiController extends Controller
{
    protected $v;
    protected $khuyenmai;

    public function __construct()
    {
        $this->v = [];
        $this->khuyenmai = new KhuyenMai();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem khuyến mại'));

        $this->v['params']  = $request->all();
        $this->v['list'] = $this->khuyenmai->index($this->v['params'], true, 10);
        return view('admin.khuyenmai.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.khuyenmai.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new KhuyenMai();
        $coupon = $this->khuyenMaiData($request, $coupon);
        $coupon->save();
        Session::flash('success', "Thêm thành công");
        return redirect()->route('route_BE_Admin_Khuyen_Mai');
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
        //
        $coupon = KhuyenMai::findOrFail($id);
        return view('admin.khuyenmai.update', compact('coupon'));
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
        // dd($request->all());
        $coupon = KhuyenMai::findOrFail($id);
        $coupon2 = $this->khuyenMaiData($request, $coupon);
        // dd($coupon);
        $coupon2->save();
        Session::flash('success', "Sửa thành công");
        return redirect()->route('route_BE_Admin_Khuyen_Mai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(mb_strtoupper('xóa khuyến mại'));

        if ($id) {
            $res = $this->khuyenmai->remove($id);
            if ($res > 0) {
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('success', 'Xóa thành công');
                return back();
            }
        }
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa khuyến mại'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['cols']['_token']);
            if (count(($params['cols'])) <= 0) {
                // dd(123);
                Session::flash('error , "Xóa không thành công');
                return back();
            }
            $res = $this->khuyenmai->remoAll($params);
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
    public function khuyenMaiData($request, $coupon)
    {
        // dd($request->all(),$coupon);
        if ($request->loai_khuyen_mai == 1) {
            $coupon->loai_khuyen_mai = $request->loai_khuyen_mai;
            $coupon->ma_khuyen_mai = $request->ma_khuyen_mai;
            $coupon->mo_ta = $request->mo_ta;
            $coupon->giam_gia = $request->giam_gia;
            $coupon->ngay_bat_dau = $request->ngay_bat_dau;
            $coupon->ngay_ket_thuc = $request->ngay_ket_thuc;
            $coupon->so_luong = $request->so_luong;
            $coupon->loai_giam_gia = $request->loai_giam_gia;
            $cupon_details = array();
            foreach ($request->khoa_hoc_ids as $id) {
                $cupon_details[] = $id;
                // array_push($cupon_details, $data);
            }
            $coupon->chi_tiet_khoa = json_encode($cupon_details);
            // dd(json_encode($cupon_details));

        } elseif ($request->loai_khuyen_mai == 2) {
            $coupon->loai_khuyen_mai = $request->loai_khuyen_mai;
            $coupon->ma_khuyen_mai = $request->ma_khuyen_mai;
            $coupon->mo_ta = $request->mo_ta;
            $coupon->giam_gia = $request->giam_gia;
            $coupon->ngay_bat_dau = $request->ngay_bat_dau;
            $coupon->ngay_ket_thuc = $request->ngay_ket_thuc;
            $coupon->loai_giam_gia = $request->loai_giam_gia;
            $coupon->so_luong = $request->so_luong;
        }

        return $coupon;
    }
    public function get_coupon_form(Request $request)
    {
        if ($request->coupon_type == 1) {
            $khoaHocs =  KhoaHoc::where('delete_at', 1)->get();
            return view('admin.khuyenmai.base_khuyen_mai_khoa_hoc', compact('khoaHocs'));
        } elseif ($request->coupon_type == 2) {
            return view('admin.khuyenmai.base_khuyen_mai_all');
        }
    }
    public function get_coupon_form_edit(Request $request)
    {
        if ($request->coupon_type == 1) {
            $coupon = KhuyenMai::findOrFail($request->id);
            $khoaHocs =  KhoaHoc::where('delete_at', 1)->get();
            return view('admin.khuyenmai.base_khuyen_mai_khoa_hoc_edit', compact('coupon', 'khoaHocs'));
        } elseif ($request->coupon_type == 2) {
            $coupon = KhuyenMai::findOrFail($request->id);
            return view('admin.khuyenmai.base_khuyen_mai_all_edit', compact('coupon'));
        }
    }

    // public function apDungKM(Request $request) {
    //     $now = date('Y-m-d',time());
    //     $objkm = new KhuyenMai();
    //     $query = KhuyenMai::where([
    //         ['ma_khuyen_mai',$request->ma_khuyen_mai],
    //         ['ngay_bat_dau','<=',$now],
    //         ['ngay_ket_thuc','>=',$now],
    //     ]);
    //     $km = $query->first();
    //     $check = false;
    //     if(!empty($km)) {
    //         if(!empty($km->chi_tiet_khoa)) {
    //             $khoaHocIds = json_decode($km->chi_tiet_khoa);
    //             foreach($khoaHocIds as $val) {
    //                 if($val == $request->id_khoa_hoc) {
    //                     $check = true;
    //                     break;
    //                 }
    //             } ;
    //             if(!$check) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'msg' => 'Mã khuyến mãi không áp dụng cho khóa học này',
    //                 ]);
    //             }
    //         }
    //         else {
    //             $check = true;
    //         }

    //     }

    //     if($check) {
    //         if(!empty(Auth::user())) {
    //             // Check user đã sử dụng mã
    //             $checkUsed = DB::table('khuyen_mai_user_da_dung')->where([
    //                 ['id_user',Auth::user()->id],
    //                 ['khuyen_mai_id',$km->id]
    //             ])->first();

    //             if(empty($checkUsed)) {
    //                 if($km->loai_khuyen_mai == 1) {
    //                     // dd($request->gia_khoa_hoc);
    //                     $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
    //                 }else {
    //                     $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
    //                 }
    //             }else {
    //                 return response()->json([
    //                     'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
    //                     'success' => false,
    //                 ]);
    //             }
    //         }
    //         // Chưa đăng nhập
    //         else {
    //             // dd(1);
    //             $checkCount = DB::table('khuyen_mai_user_da_dung')->where([
    //                 ['khuyen_mai_id',$km->id]
    //             ])->count();
    //             if($checkCount > $km->so_luong) {
    //                 return response()->json([
    //                     'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
    //                     'success' => false,
    //                 ]);
    //             }else {

    //                 if($km->loai_khuyen_mai == 1) {
    //                     $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
    //                     // dd($request->gia_khoa_hoc);
    //                 }else {
    //                     $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
    //                 }
    //             }
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'gia_khoa_hoc' => $giaKhoaHoc,
    //             'id_km' => $km->id
    //         ]);
    //     }else {
    //         return response()->json([
    //             'success' => false,
    //             'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
    //         ]);
    //     }

    // }

    public function apDungKM(Request $request)
    {
        $now = date('Y-m-d', time());
        $objkm = new KhuyenMai();
        $query = KhuyenMai::where([
            ['ma_khuyen_mai', $request->ma_khuyen_mai],
            ['ngay_bat_dau', '<=', $now],
            ['ngay_ket_thuc', '>=', $now],
        ]);
        $km = $query->first();
        $check = false;
        if (!empty($km)) {
            if (!empty($km->chi_tiet_khoa)) {
                $khoaHocIds = json_decode($km->chi_tiet_khoa);
                foreach ($khoaHocIds as $val) {
                    if ($val == $request->id_khoa_hoc) {
                        $check = true;
                        break;
                    }
                };
                if (!$check) {
                    return response()->json([
                        'success' => false,
                        'msg' => 'Mã khuyến mãi không áp dụng cho khóa học này',
                    ]);
                }
            } else {
                $check = true;
            }
        }

        if ($check) {
            if (!empty(Auth::user())) {
                // Check user đã sử dụng mã
                $checkUsed = DB::table('khuyen_mai_user_da_dung')->where([
                    ['id_user', Auth::user()->id],
                    ['khuyen_mai_id', $km->id]
                ])->first();
                if(empty($checkUsed)) {
                    if($km->loai_khuyen_mai == 1) {
                        // dd($request->gia_khoa_hoc);
                        if($km->loai_giam_gia==1){
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
                        }
                        else{
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
                        }
                       
                    }else {
                        if($km->loai_giam_gia==1){
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
                        }
                        else{
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
                        }

                    }
                } else {
                    return response()->json([
                        'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
                        'success' => false,
                    ]);
                }
            }
            // Chưa đăng nhập
            else {
                // dd(1);
                $checkCount = DB::table('khuyen_mai_user_da_dung')->where([
                    ['khuyen_mai_id', $km->id]
                ])->count();
                if ($checkCount > $km->so_luong) {
                    return response()->json([
                        'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
                        'success' => false,
                    ]);

                }else {
                    if($km->loai_khuyen_mai == 1) {
                        // dd($request->gia_khoa_hoc);
                        if($km->loai_giam_gia==1){
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
                        }
                        else{
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
                        }
                       
                    }else {
                        if($km->loai_giam_gia==1){
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - (int)$km->giam_gia;
                        }
                        else{
                            $giaKhoaHoc = (int)$request->gia_khoa_hoc - ((int)$request->gia_khoa_hoc * (int)$km->giam_gia / 100);
                        }

                    }
                }
            }
            return response()->json([
                'success' => true,
                'gia_khoa_hoc' => $giaKhoaHoc,
                'id_km' => $km->id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Mã khuyến mãi đã được sử dụng hoặc đã hết hạn',
            ]);
        }
    }
}
