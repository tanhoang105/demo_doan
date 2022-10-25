<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThanhToanCollection;
use App\Models\ThanhToan;
use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    //
    public function index(Request $request){
        $objThanhToan=new ThanhToan();
        $params=$request->all();
        $list=ThanhToan::all();
        return new ThanhToanCollection($list);
    }
}
