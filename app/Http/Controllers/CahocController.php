<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CahocController extends Controller
{
    public function ShowAllList(){
        $list = DB::table('ca_hoc')->get();
        dd($list);
    }
}
