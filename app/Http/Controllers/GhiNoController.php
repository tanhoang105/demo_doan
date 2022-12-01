<?php

namespace App\Http\Controllers;

use App\Models\GhiNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GhiNoController extends Controller
{
    public function tk_ghi_no()
    {
        $ghi_no = GhiNo::where('user_id', '=', Auth::user()->id)
            ->join('users', 'users.id', '=', 'ghi_no.user_id')
            ->select('ghi_no.*', 'users.name')
            ->get();
        return view('client.ghi_no.index', compact('ghi_no'));
    }
    public function quan_ly_tk_ghi_no()
    {
        $ghi_no = GhiNo::join('users', 'users.id', '=', 'ghi_no.user_id')
            ->select('ghi_no.*', 'users.name')
            ->paginate(6);
        return view('Admin.tk_ghi_no.index', compact('ghi_no'));
    }
    public function cap_nhat_so_du(Request $request, $id)
    {
        // dd($request->all());
        $data = GhiNo::find($id);
        $data->tien_no = $request->tien_no_new;
        $data->save();
        return redirect()->back();
    }
}
