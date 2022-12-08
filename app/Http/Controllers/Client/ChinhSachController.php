<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ChinhSach;
use Illuminate\Http\Request;

class ChinhSachController extends Controller
{
    protected $v;
    protected $chinhsach;

    public function __construct()
    {
        $this->v = [];
        $this->chinhsach  = new ChinhSach();
    }
    public function index(Request $request)
    {
        $this->v['params'] = $request->all();
        $this->v['chinhsach'] = $this->chinhsach->index(null, false, null);
        return view('client.chinh-sach.index', $this->v);
    }
}
