<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaHocCollection;
use App\Models\CaHoc;
use Illuminate\Http\Request;

class CaHocController extends Controller
{
    //
    public function index(Request $request){
        $objCaHoc=new CaHoc();
        $params=$request->all();
        $list=$objCaHoc->index($params ,false,'');
        return new CaHocCollection($list);
    }
}
