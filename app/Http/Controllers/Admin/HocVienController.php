<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HocVienRequest;
use App\Models\GhiNo;
use App\Models\HocVien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HocVienController extends Controller
{

    protected $v, $hocvien, $user;
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
    public function index(Request $request)
    {

        $this->authorize(mb_strtoupper('xem học viên'));

        $this->v['params'] = $request->all();
        $this->v['list'] = $this->hocvien->index($this->v['params'], true, 10);
        // dd($this->v['list']);
        return view('admin.hocvien.index', $this->v);
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
    public function store(HocVienRequest $request)
    {
        $this->v['params'] = $request->all();
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
            $params['cols']['vai_tro_id'] = 4;
            $params['cols']['hinh_anh'] = null;
            // dd($params);
            if ($request->file('hinh_anh')) {

                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }
            //            dd($params['cols']);
            $res = $this->user->create($params);

            if ($res > 0) {

                $this->hocvien->insert([
                    'user_id' => $res,
                    'ten_hoc_vien' => $params['cols']['name'],
                    'dia_chi' => $params['cols']['dia_chi'],
                    'email' => $params['cols']['email'],
                    'sdt' => $params['cols']['sdt'],
                    'hinh_anh' => $params['cols']['hinh_anh'],
                ]);
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
                return redirect()->route('route_BE_Admin_List_Hoc_Vien');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_List_Hoc_Vien');
            }
        }
        return view('admin.hocvien.add', $this->v);
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
            $res  =  $this->hocvien->show($id);
            $this->v['res'] = $res;
            return view('admin.hocvien.update', $this->v);
        } else {
            Session::flash('error', "Lỗi không tìm đc bản ghi");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HocVienRequest $request)
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
                HocVien::where('user_id', $id)->update([
                    'user_id' => $id,
                    'ten_hoc_vien' => $params['cols']['name'],
                    'dia_chi' => $params['cols']['dia_chi'],
                    'email' => $params['cols']['email'],
                    'sdt' => $params['cols']['sdt'],
                    'hinh_anh' => $params['cols']['hinh_anh'],
                ]);

                Session::flash('success', 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_List_Hoc_Vien');
            } else {
                Session::flash('error', 'Cập nhập không thành công');
                return redirect()->route('route_BE_Admin_List_Hoc_Vien');
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
    // id học viên xóa
    {
        $this->authorize(mb_strtoupper('xóa học viên'));

        // xóa học viên trong bảng học viên thì xóa luôn trong bảng user
        if ($id) {

            $res = $this->hocvien->remove($id);

            // dd($id_user);
            // xóa học viên xóa => users
            if ($res > 0) {
                $this->user->remove($id);
                Session::flash('success', 'Xóa thành công ');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công ');
                return back();
            }
        }
    }


    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa học viên'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->hocvien->remoAll($params);
            // dd($res);

            if ($res > 0) {
                // khi xóa thành công những học viên này thì cần xóa những user có id tương ứng với user_id học viên
                $this->user->remoAll($params);
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }

    public function exportExcel()
    {
    }

    public function uploadFile($file)
    {
        $filename =  time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageHocvien', $filename,  'public');
    }
}
