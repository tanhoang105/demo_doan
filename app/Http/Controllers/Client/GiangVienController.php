<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiangVienController extends Controller
{
    //
    public function index()
    {
        $giang_vien = DB::table('giang_vien')->select('giang_vien.*')
            ->get();
        // dd($data);
        return view('client.giang-vien.giang-vien', compact('giang_vien'));
    }
    public function chiTietGiangVien(){
        return view('client.giang-vien.chi-tiet-giang-vien');
    }
}
