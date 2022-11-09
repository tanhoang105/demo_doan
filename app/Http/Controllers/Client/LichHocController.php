<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LichHocController extends Controller
{
     public function index() {

         return view('client.lich-hoc.lich-hoc');
     }
}
