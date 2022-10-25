<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhongHocCollection;
use App\Models\PhongHoc;
use Illuminate\Http\Request;

class PhongHocController extends Controller
{
    //
    public function index(Request $request){
        $objPhongHoc=new PhongHoc();
        $params = $request->all();
        $list = $objPhongHoc->index($params, false, '');
        return new PhongHocCollection($list);
//        return response()->json($list);
    }
}
