<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\XepLop;
use Illuminate\Http\Request;

class LopController extends Controller
{
    protected $v;
    protected $xeplop;

    public function __construct()
    {
        $this->v = [];
        $this->xeplop = new XepLop();
    }
    public function index(Request $request)
    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('yy-m-d');

        $this->v['params'] = $request->all();

        $xeplop = $this->xeplop->index($this->v['params'], true, 6);
        $this->v['list'] = $xeplop;

        return view('client.lop.lop', $this->v);
    }
}
