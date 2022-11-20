<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\LichHoc;
use App\Models\Lop;
use App\Models\ThuHoc;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CaThuController extends Controller
{

    protected $v,  $cahoc, $thu, $cathu;
    public function __construct()
    {
        $this->v = [];
        $this->cahoc  = new CaHoc();
        $this->thu = new ThuHoc();
        $this->cathu = new CaThu();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->v['params'] =  $request->all();
        $this->v['cahoc'] = $this->cahoc->index(null, false, null);
        $this->v['thu'] = $this->thu->index(null, false, null);
        $this->v['list'] = $this->cathu->index($this->v['params'], true, 10);



        return view('admin.lichhoc.index', $this->v);
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
        //
        $this->v['ca'] = $this->cahoc->index(null, false, null);
        $this->v['thuhoc'] = $this->thu->index(null, false, null);
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
            // dd($request->all());

            unset($params['cols']['_token']);
            // dd($params['cols']);
            // dd(implode("," , $params['cols']['thu_hoc_id']));

            $res = $this->cathu->create($params);
            if ($res > 0) {
                Session::flash('success', 'Thêm thành công');
            } else {
                Session::flash('error', "Thêm không thành công");
            }

            return redirect()->route('route_BE_Admin_List_Ca_Thu');
        }

        return view('admin.lichhoc.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        function createDatesTable($period, $start)
        {
            // tìm lớp  theo id
            $lop = Lop::find(1);
           
          
            // dd(($lop->ca_thu_id));
            // tìm record ở bảng ca thứ dựa vào id của nó trong bảng lớp (ca_thu_id)
            $thu = CaThu::find($lop->ca_thu_id);
           

            
            $ca =  CaHoc::find($thu->ca_id);
          
            // dd($thu->thu_hoc_id);
            $arrayThuCuaLop = explode(',', $thu->thu_hoc_id);
            // dd($arrayThuCuaLop);
            $arrayid = [];
            for ($i=0; $i < count($arrayThuCuaLop); $i++) { 
                    $arrayid[] = (int)$arrayThuCuaLop[$i];
            }  
            // dd($arrayid);
            // lấy mảng mã thứ theo id 
            $arrayMaThu =  DB::table('thu_hoc')->select('thu_hoc.ma_thu')->whereIn('id', $arrayid )->get();
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
                   
                    if (  $dayofweek  ==  $arrayMaThu[$i]->ma_thu) {
                    //  dd($lop->id);
                        $lichHoc = new LichHoc();
                        $params['cols'] = [
                            'ma_thu' => (int) $dayofweek,
                            'ca_id' => $ca->id,
                            'ngay_hoc' => $date_row->format('Y-m-d'),
                            'lop_id' => $lop->id
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

            return $calendarStr;
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
                $calendarStr .= createDatesTable($period, $start);
            } else {
                $calendarStr .= createDatesTable($period, $start);
            }
            // dd($calendarStr);
            $calendarStr .= '</table>';

            return $calendarStr;
        }

        // $startTime = strtotime('+25 day', time());
        // $d = DateTime::createFromFormat(date('2022-11-17'),  '22-09-2008 00:00:00');
        // $d = $d->getTimestamp();
        $startTime =  strtotime(date('2022-11-18'));
        $endTime = strtotime(date('2022-12-17'));
        // $endTime = strtotime('+30 day', time());
        $this->v['lich'] = createCalendarBetweenTwoDates($startTime, $endTime);
        // echo createCalendarBetweenTwoDates($startTime, $endTime);
        return view('admin.lichhoc.show', $this->v);
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
            // id của ca
            $request->session()->put('id', $id);
            $this->v['ca'] = $this->cahoc->index(null, false, null);
            $this->v['res'] = $this->cathu->show($id);
            $this->v['thuhoc'] = $this->thu->index(null, false, null);
            $this->v['lichhoc'] = $this->cathu->show($id);

            $arrayThuTheoCa = explode(',', $this->v['lichhoc']->thu_hoc_id);
            $this->v['arrayThuTheoCa'] = $arrayThuTheoCa;

            return view('admin.lichhoc.update', $this->v);
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
        }, $request->all());

        unset($params['cols']['_token']);
        $params['cols']['id'] =  $id;
        // dd($params);
        // $this->v['lichhoc'] = $this->cathu->show($id);

        // $arrayThuTheoCa = [ $this->v['lichhoc']->thu_hoc_id ];
        // // dd($arrayThuTheoCa)
        // $arrayThuTheoCa->detach();
        $res = $this->cathu->saveupdate($params);
        if ($res) {
            Session::flash('success', "Cập nhập thành công");
        } else {
            Session::flash('error', "Cập nhập không thành công");
        }


        return back();
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
            $res = $this->cathu->remove($id);
            if ($res) {
                Session::flash('success', 'Xóa thành công');
            } else {
                Session::flash('error', "Xóa không thành công");
            }
            return back();
        }
    }


    public function destroyAll(Request $request)
    {

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['cols']['_token']);
            $res = $this->cathu->remoAll($params);


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
