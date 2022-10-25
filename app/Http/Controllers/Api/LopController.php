<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LopCollection;
use App\Models\Lop;
use Illuminate\Http\Request;

class LopController extends Controller
{
    //
        public function index(Request $request){
            $objLop=new Lop();
            $params=$request->all();
            $list=$objLop->index($params , false ,'');
            return new LopCollection($list);
//        dd($list);
//        return response()->json($list);
        }
//         return response()->json($list);
}
