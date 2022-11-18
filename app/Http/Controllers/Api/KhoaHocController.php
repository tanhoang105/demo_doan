<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\KhoaHocCollection;

class KhoaHocController extends Controller
{
    //
    public function index(Request $request){
        $objKhoaHoc=new KhoaHoc();
        $pramas=$request->all();
        $list=$objKhoaHoc->index($pramas , false ,'');
//         return new KhoaHocCollection($list);
// //        dd($list);
       return response()->json($list);
    }
}
