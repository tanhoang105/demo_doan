<?php

namespace App\Http\Controllers;

use App\Models\GhiNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GhiNoController extends Controller
{
    public function tk_ghi_no ()
    {
        $ghi_no = GhiNo::where('user_id','=',Auth::user()->id)
        ->join('users','users.id','=','ghi_no.user_id')
        ->select('ghi_no.*','users.name')
        ->get();
        return view('client.ghi_no.index',compact('ghi_no'));
    }
}
