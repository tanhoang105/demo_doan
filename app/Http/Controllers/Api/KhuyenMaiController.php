<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KhuyenMaiCollection;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    //
    public function index(Request $request){
        $objKhuyenMai=new KhuyenMai();
        $params=$request->all();
        $list=$objKhuyenMai->index($params,false,'');
        return new KhuyenMaiCollection($list);
    }
}
