<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DangKyController extends Controller
{
    //
    public function index(){
        return view('client.khoa-hoc.dang-ky-khoa-hoc');
    }
}
