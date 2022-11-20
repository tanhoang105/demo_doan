<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GiangVienCollection;
use App\Http\Resources\PhongHocCollection;
use App\Models\GiangVien;
use App\Models\PhongHoc;
use Illuminate\Http\Request;

class GiangVienController extends Controller
{
    //
    public function index(Request $request){
        $objGiangVien=new GiangVien();
        $params = $request->all();
        $list = $objGiangVien->index($params, false, '');
        // return new GiangVienCollection($list);
       return response()->json($list);
    }
}
