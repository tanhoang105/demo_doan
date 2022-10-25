<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DanhMucCollection;
use App\Http\Resources\XepLopCollection;
use App\Models\DanhMuc;
use App\Models\XepLop;
use Illuminate\Http\Request;

class XepLopController extends Controller
{
    //
    public function index(Request $request){
        $objXepLop=new XepLop();
        $params = $request->all();
        $list = $objXepLop->index($params, false, '');
        return new XepLopCollection($list);
//        return response()->json($list);
    }
}
