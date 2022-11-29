<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HocVien;
use App\Models\Lop;
use App\Models\PhuongThucThanhToan;
use App\Models\ThanhToan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use PDF;

class ThanhToanController extends Controller
{

    protected $v, $thanhtoan, $phuongthucthanhtoan , $lop , $hocvien;
    public function __construct()
    {
        $this->v = [];
        $this->thanhtoan = new ThanhToan();
        $this->phuongthucthanhtoan = new PhuongThucThanhToan();
        $this->lop = new Lop();
        $this->hocvien = new HocVien();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $this->v['list'] = $this->thanhtoan->index($this->v['params'], true, 10);
        $this->v['phuongthucthanhtoan'] = $this->phuongthucthanhtoan->index(null, false, null);
        // dd($this->v['list']);
        return view('admin.thanhtoan.index', $this->v);
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
        $this->v['phuongthucthanhtoan']  = $this->phuongthucthanhtoan->index(null, false, null);

        if ($request->isMethod("POST")) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                if ($item == '') {
                    $item   = null;
                }

                if (is_string($item)) {
                    $item = trim($item);
                }

                return $item;
            }, $request->post());

            unset($params['cols']['_token']);
            $res = $this->thanhtoan->create($params);
            if ($res > 0) {
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_List_Thanh_Toan');
            } else {
                Session::flash('error', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_List_Thanh_Toan');
            }
        }
        return view('admin.thanhtoan.add', $this->v);
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
            $this->v['phuongthucthanhtoan'] = $this->phuongthucthanhtoan->index(null, false, null);

            $res = $this->thanhtoan->show($id);
            // dd($res);
            if ($res) {

                $this->v['res'] = $res;
                return view('admin.thanhtoan.update', $this->v);
            } else {
                Session::flash('error', "Lỗi hiển thị");
                return back();
            }
        }
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
        if ($id) {
            $res  = $this->thanhtoan->remove($id);
            if ($res) {
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', "Xóa thành công");
                return back();
            }
        }
    }


    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa thanh toán'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->thanhtoan->remoAll($params);
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

    public function inHoaDon($id)
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTMl($this->print_order_convert($id));
        // return $pdf->stream();
        $this->v['list'] =  $this->print_order_convert($id);
        // dd($this->v['list']);
        $this->v['lop'] = $this->lop->index(null , false  , null);
        $this->v['hocvien'] = $this->hocvien->index(null , false  , null);
        // dd($this->v['list']->id);
        $pdf = FacadePdf::loadView('admin.pdf',$this->v );
   
        return $pdf->download('tuts_notes.pdf');
    }


    public function print_order_convert($id)
    {
        $hoaDon = $this->thanhtoan->inhoahon($id);
        return $hoaDon;
    }
}
