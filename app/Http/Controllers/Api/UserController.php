<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DanhMucCollection;
use App\Http\Resources\UserCollection;
use App\Models\DanhMuc;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $objUser=new User();
        $params = $request->all();
        $list = $objUser->index($params, false, '');
        return new UserCollection($list);
//        return response()->json($list);
    }
}
