<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThongTinController extends Controller
{
    public function index() {
        return view('client.thong-tin-ca-nhan.index');
    }
}
