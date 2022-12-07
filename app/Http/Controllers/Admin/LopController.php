<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LopRequest;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lich;
use App\Models\LichHoc;
use App\Models\Lop;
use App\Models\ThuHoc;
use App\Models\User;
use App\Models\XepLop;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LopController extends Controller
{
    protected $v;
    protected $lophoc;
    protected $khoahoc, $cahoc, $giangvien, $cathu, $thu,  $lich , $xepLop;

    public function __construct()
    {
        $this->v = [];
        $this->lophoc =  new Lop();
        $this->giangvien  = new  GiangVien();
        $this->khoahoc = new KhoaHoc();
        $this->cahoc = new CaHoc();
        $this->cathu = new CaThu();
        $this->thu = new ThuHoc();
        $this->lich = new Lich();
        $this->xepLop = new XepLop();
    }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize(mb_strtoupper('xem lớp học'));

        $this->v['params'] =  $request->all();
        // dd($this->v['params']);
        // dd($request->get());
        $this->v['khoa_hoc'] = $this->khoahoc->index(null, false, null);
        $this->v['giang_vien'] = $this->giangvien->index(null, false, null);
        $this->v['cahoc'] = $this->cahoc->index(null, false, null);
        // lọc
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
        // dd($params);
        if($request->keyword){
           
            $params['loc']['keyword'] = $request->keyword;
            
        }

       
        $list = $this->lophoc->index($params, true, 10);
        $this->v['list'] = $list;

        $this->v['giangvien'] = $this->giangvien->index($this->v['params'], false, null);
        // dd($this->v['giangvien'][2]);   


        $this->v['cahoc'] = $this->cahoc->index(null, false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['listcathu'] = $this->cathu->index(null, false, null);

        return view('admin.lop.index', $this->v);
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_xep_lop)
    {
        $this->authorize(mb_strtoupper('xem lớp học'));

        if (isset($id_xep_lop)) {
            // dd(12);

            $res =  $this->lophoc->show($id_xep_lop);
            if ($res) {
                $this->v['item'] = $res;
                $this->v['giangvien'] = $this->giangvien->index(null, false, null);
                $this->v['cahoc'] = $this->cahoc->index(null, false, null);
                // dd($this->v['cahoc']);
                return view('admin.xeplop.detail', $this->v);
            }
        }
    }

    public function detail($id, Request $request)
    {
        $lop = $this->lophoc->show($id);
        $request->session()->put('id',  $lop->id);
        function createDatesTable($period, $start)
        {
            // tìm lớp  theo id
            $lop = Lop::find(session('id'));
            // dd(($lop->ca_thu_id));
            // tìm record ở bảng ca thứ dựa vào id của nó trong bảng lớp (ca_thu_id)
            $thu = CaThu::find($lop->ca_thu_id);



            $ca =  CaHoc::find($thu->ca_id);

            // dd($thu->thu_hoc_id);
            $arrayThuCuaLop = explode(',', $thu->thu_hoc_id);
            // dd($arrayThuCuaLop);
            $arrayid = [];
            for ($i = 0; $i < count($arrayThuCuaLop); $i++) {
                $arrayid[] = (int)$arrayThuCuaLop[$i];
            }
            // dd($arrayid);
            // lấy mảng mã thứ theo id 
            $arrayMaThu =  DB::table('thu_hoc')->select('thu_hoc.ma_thu')->whereIn('id', $arrayid)->get();
            // dd($arrayMaThu);

            $calendarStr = '';

            foreach ($period as $key => $date_row) {

                if ($start % 7 == 0) {
                    $calendarStr .= '</div><div class="row" style="height: 100px;">';
                }
                $css = '';
                $tenca = '';
                $th_start = null;
                $th_end = null;

                $dayofweek = date('w', strtotime($date_row->format('Y-m-d')));

                // dd($dayofweek);

                for ($i = 0; $i < count($arrayMaThu); $i++) {
                    // dd($arrayMaThu[$i]->ma_thu);
                    // so sánh mã chuyển đổi của ngày với cột mã thứ trong bảng thứ học

                    if ($dayofweek  ==  $arrayMaThu[$i]->ma_thu) {

                        // $flag[] = $date_row->format('Y-m-d');
                        $css =  'style="color: red;"';
                        $tenca = $ca->ca_hoc;
                        $th_start = ' ( ' . $ca->thoi_gian_bat_dau . ' -- ';
                        $th_end = $ca->thoi_gian_ket_thuc . ' ) ';

                        // $calendarStr .= '<td style="background: red;" class="date">'  . 1 .  '</td>';



                    }
                }

                $calendarStr .= '<div stule="width:15%" class="col date border"' . $css . ' >
                    <div class="p-2">' . $date_row->format('d') . "<br>" . '<span>' . $tenca . '</span>' .  '<span>' . $th_start . '</span>' . '<span>' . $th_end   . '</span>' . '</div></div>';


                $start++;
            }
            // dd($flag);

            if ($start % 7 == 0) {
                $calendarStr .= '</tr>';
            } else {
                for ($i = 0; $i <= 6; $i++) {
                    if ($start % 7 != 0)
                        $calendarStr .= '<div class="col empty_dates border" style="background: #b8bdc2;"></div>';
                    else
                        break;
                    $start++;
                }
                $calendarStr .= '</tr>';
            }

            return $calendarStr;
        }

        function createCalendarBetweenTwoDates($startTime, $endTime)
        {

            $calendarStr = '';
            $weekDays = array(
                'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
            );

            $calendarStr .= '<div class="calendar border" style="font-weight: 600;">';

            $calendarStr .= '<div class="row bg-primary" ><div class="col week-days border" >' . implode('</div><div class="col week-days border">', $weekDays) . '</div></div>';


            $period = new DatePeriod(
                new DateTime(date('Y-m-d', $startTime)),
                new DateInterval('P1D'),
                new DateTime(date('Y-m-d', $endTime))
            );

            $currentDay = array_search(date('D', $startTime), $weekDays);
            $start = 0;

            $calendarStr .= '<div class="row" style="height: 100px;">';
            for ($i = $start; $i < $currentDay; $i++) {
                $calendarStr .= '<div class="col empty date border" style="background: #b8bdc2;"></div>';
                $start++;
            }

            if ($currentDay < 6) {
                $calendarStr .= createDatesTable($period, $start);
            } else {
                $calendarStr .= createDatesTable($period, $start);
            }
            // dd($calendarStr);
            $calendarStr .= '</div></div>';

            return $calendarStr;
        }

        // $startTime = strtotime('+25 day', time());
        // $d = DateTime::createFromFormat(date('2022-11-17'),  '22-09-2008 00:00:00');
        // $d = $d->getTimestamp();
        $startTime =  strtotime(date($lop->ngay_bat_dau));
        $endTime = strtotime(date($lop->ngay_ket_thuc));
        // $endTime = strtotime('+30 day', time());
        $this->v['lich'] = createCalendarBetweenTwoDates($startTime, $endTime);
        return view('admin.lop.detail', $this->v);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->authorize(mb_strtoupper('edit lớp học'));

        if ($id) {
            $request->session()->put('id', $id);
            $this->v['khoahoc'] = $this->khoahoc->index(null, false, null);
            $this->v['giangvien'] = $this->giangvien->index(null, false, null);
            // dd($this->v['khoahoc']);
            $this->v['lop'] = $this->lophoc->show($id);
            // dd($this->v['lop']);
            return view('admin.lop.update', $this->v);
        } else {
            Session::flash('error', 'Lỗi');
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
    public function update(LopRequest $request)
    {

        $this->authorize(mb_strtoupper('update lớp học'));

        // dd(123);
        if (session('id')) {
            $id = session('id');
            // dd($id);
            $params  = [];
            $params['cols'] = array_map(function ($item) {
                if ($item == '') {
                    $item  = null;
                }
                if (is_string($item)) {
                    $item = trim($item);
                }

                return $item;
            }, $request->post());
            unset($params['cols']['_token']);
            $params['cols']['id'] = $id;

            // dd($params);
            $res = $this->lophoc->saveupdate($params);
            if ($res) {
                Session::flash('success', "Cập nhập thành công");
                return redirect()->route('route_BE_Admin_List_Lop');
            } else {
                Session::flash('error', "Cập nhập không thành công");
                return redirect()->route('route_BE_Admin_List_Lop');
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
        $this->authorize(mb_strtoupper('xóa lớp học'));

        if ($id) {
            $res = $this->lophoc->remove($id);
            if ($res > 0) {
                // khi xóa thành công lớp thì xóa luôn lịch học của lớp đó
                $this->lich->removeWithIDLop($id);
                $this->xepLop->remoWithIdLop($id);
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', "Xóa không thành công");
                return back();
            }
        } else {
            Session::flash('error', 'Lỗi xảy ra');
            return back();
        }
    }

    public function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imgLopHoc', $filename, 'public');
    }

    public function destroyAll(Request $request)
    {

        $this->authorize(mb_strtoupper('xóa lớp học'));

        // dd($request->all);
        // $request  =  $request->all();
        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['_token']);
            $res = $this->lophoc->remoAll($params);
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

    public function autocomplete(Request $request)
    {

        $data = $request->all();

        if ($data['query']) {
            $lop = Lop::where('delete_at', '=', 1)
                ->where('ten_lop', 'LIKE', '%'  . $data['query'] . '%')->get();
            $output = '<ul class="dropdown-menu" style= "display: block;position: absolute;width: 100%; padding-left: 5px;" >';
            foreach ($lop as $value) {
                $output  .= '<li class="ajax" style="cursor: pointer;"> ' . $value->ten_lop .  '</li>';
            }

            $output .= '</ul>';

            echo $output;
        }
    }





    public function store(Request $request)
    {
        //
        // dd(123);
        $this->authorize(mb_strtoupper('thêm lớp học'));
        $this->v['cahoc'] = $this->cahoc->index(null, false, null);
        // dd($this->v['cahoc']);
        $this->v['thu'] = $this->thu->index(null, false, null);
        // $this->v['list'] = $this->cathu->index($this->v['params'], true, 10);

        $this->v['khoahoc'] = $this->khoahoc->index(null, false, null);
        $this->v['giangvien'] = $this->giangvien->index(null, false, null);
        $this->v['cathu'] = $this->cathu->index(null, false, null);
        // dd($this->v['cathu']);
        if ($request->isMethod('POST')) {
            // thêm sản phẩm
        // dd($request->all());
        // dd()

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
            $params['cols']['so_luong'] = 40;

            $timeStart = $params['cols']['ngay_bat_dau'];

            $timeEnd = strtotime('+' . $params['cols']['thoi_gian'] . 'month', strtotime($timeStart));
            $timeEnd = date('Y-m-d', $timeEnd);
            $params['cols']['ngay_ket_thuc'] =  $timeEnd;
            // dd($params);
            unset($params['cols']['thoi_gian']);
            $res = $this->lophoc->create($params);

            if ($res > 0) {
                // khi thêm giảng vien vào lớp thì cần update lại trạng thái của giảng viên đó 1 là chưa có lớp dạy , 2 là đã có lớp dạy
                // GiangVien::where('id_user', $params['cols']['id_giang_vien'])->update([

                //     'trang_thai' => 2
                // ]);
                // User::where('id', $params['cols']['id_giang_vien'])->update([

                //     'trang_thai' => 2
                // ]);
                $request->session()->put('idLopCurrent', $res);
                // thêm thành công
                // khi thêm thành công thì đồng nghĩa isnsert thời gian học vào bảng lịch học để 
                $lopCurrent =  $this->lophoc->show($res);
                // dd($lopCurrent);



                $startTime = strtotime(date($lopCurrent->ngay_bat_dau));
                $endTime = strtotime(date($lopCurrent->ngay_ket_thuc));
                $this->createCalendarBetweenTwoDates($startTime, $endTime);



                Session::flash('seccuss', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_List_Lop');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_List_Lop');
            }
        }

        return view('admin.lop.add', $this->v);
    }



    function createDatesTable($period, $start)
    {
        // tìm lớp  theo id
        // dd(session('idLopCurrent'));
        $lop = Lop::find(session('idLopCurrent'));
        // dd(session('idLopCurrent'));
        // dd(($lop->ca_thu_id));
        // tìm record ở bảng ca thứ dựa vào id của nó trong bảng lớp (ca_thu_id)
        $thu = CaThu::find($lop->ca_thu_id);
        $ca =  CaHoc::find($thu->ca_id);
        // $xepLop = XepLop::where('id_lop' , $lop->id)->first();
        // dd($xepLop);
        // $phongHocID = $xepLop->id_phong_hoc;
        // dd($thu->thu_hoc_id);
        $arrayThuCuaLop = explode(',', $thu->thu_hoc_id);
        // dd($arrayThuCuaLop);
        $arrayid = [];
        for ($i = 0; $i < count($arrayThuCuaLop); $i++) {
            $arrayid[] = (int)$arrayThuCuaLop[$i];
        }
        // dd($arrayid);
        // lấy mảng mã thứ theo id 
        $arrayMaThu =  DB::table('thu_hoc')->select('thu_hoc.ma_thu')->whereIn('id', $arrayid)->get();
        // dd($arrayMaThu);

        $calendarStr = '';
        $flag = [];
        foreach ($period as $key => $date_row) {

            if ($start % 7 == 0) {
                $calendarStr .= '</tr><tr>';
            }
            $css = '';
            $tenca = '';
            // $calendarStr .= '<td class="date" ' . $css . ' >' . $date_row->format('d') . '</td>';
            // $calendarStr .= '<td class="date">' .  . '</td>';


            // $date = "2022-11-18";
            // dd($date_row->format('Y-m-d'));
            $dayofweek = date('w', strtotime($date_row->format('Y-m-d')));

            // dd($dayofweek);

            for ($i = 0; $i < count($arrayMaThu); $i++) {
                // dd($arrayMaThu[$i]->ma_thu);
                // so sánh mã chuyển đổi của ngày với cột mã thứ trong bảng thứ học
                if ($dayofweek  ==  $arrayMaThu[$i]->ma_thu) {
                    // dd(123);
                    $lichHoc = new LichHoc();
                    $params['cols'] = [
                        'ma_thu' => (int) $dayofweek,
                        'ca_id' => $ca->id,
                        'ngay_hoc' => $date_row->format('Y-m-d'),
                        'lop_id' => $lop->id,
                        'giang_vien_id' => $lop->id_giang_vien,


                    ];
                    // dd($params);
                    $lichHoc->create($params);
                    // $flag[] = $date_row->format('Y-m-d');
                    $css =  'style="color: red;     padding-top: 19px;"';
                    $tenca = $ca->ca_hoc;

                    // $calendarStr .= '<td style="background: red;" class="date">'  . 1 .  '</td>';



                }
            }

            $calendarStr .= '<td class="date" ' . $css . ' >' . $date_row->format('d') . "<br>" . '<span>' . $tenca . '</span>' .  '</td>';


            $start++;
        }
        // dd($flag);

        if ($start % 7 == 0) {
            $calendarStr .= '</tr>';
        } else {
            for ($i = 0; $i <= 6; $i++) {
                if ($start % 7 != 0)
                    $calendarStr .= '<td class="empty_dates"></td>';
                else
                    break;
                $start++;
            }
            $calendarStr .= '</tr>';
        }

        // return $calendarStr;
        return 1;
    }

    function createCalendarBetweenTwoDates($startTime, $endTime)
    {

        $calendarStr = '';
        $weekDays = array(
            'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
        );

        $calendarStr .= '<table class="table" >';

        $calendarStr .= '<tr><th class="week-days">' . implode('</th><th class="week-days">', $weekDays) . '</th></tr>';


        $period = new DatePeriod(
            new DateTime(date('Y-m-d', $startTime)),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', $endTime))
        );

        $currentDay = array_search(date('D', $startTime), $weekDays);
        $start = 0;

        $calendarStr .= '<tr>';
        for ($i = $start; $i < $currentDay; $i++) {
            $calendarStr .= '<td class="empty date"></td>';
            $start++;
        }

        if ($currentDay < 6) {
            $calendarStr .= $this->createDatesTable($period, $start);
        } else {
            $calendarStr .= $this->createDatesTable($period, $start);
        }
        // dd($calendarStr);
        $calendarStr .= '</table>';

        return $calendarStr;
    }
}
