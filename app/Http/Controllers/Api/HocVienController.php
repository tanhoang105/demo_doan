<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HocVienCollection;
use App\Models\HocVien;
use Illuminate\Http\Request;

class HocVienController extends Controller
{
    //
    public function index(Request $request){
        $objHocVien=new HocVien();
        $params = $request->all();
        $list = $objHocVien->index($params, false, '');
//        dd($list);
        return new HocVienCollection($list);
//        return response()->json($list);
    }
}
