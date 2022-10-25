<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DanhMucCollection;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{

    public function index(Request $request){
        $objDanhMuc=new DanhMuc();
        $params = $request->all();
        $list = $objDanhMuc->index($params, false, '');
        return new DanhMucCollection($list);
//        return response()->json($list);
    }
}
