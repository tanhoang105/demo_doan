<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DangKyCollection;
use App\Models\DangKy;
use Illuminate\Http\Request;

class DangKyController extends Controller
{
    //
    public function index(Request $request){
        $objDangKy=new DangKy();
        $params= $request->all();
        $list=DangKy::all();
        return new DangKyCollection($list);
    }
}
