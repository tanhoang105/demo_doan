<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChoPhep;
use App\Models\User;
use App\Models\VaiTro;
use App\Models\VaiTroChoPhep;
use Illuminate\Http\Request;

class CapQuyenController extends Controller
{
    protected $v, $vaitrochophep, $vaitro, $user , $chophep;

    public function __construct()
    {
        $this->v = [];
        $this->vaitrochophep = new VaiTroChoPhep();
        $this->vaitro = new VaiTro();
        $this->user = new User();
        $this->chophep = new ChoPhep();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hiển thị ra những tài khoản -> vai trò  -> quyền 
        $vaitro = User::all();
        // dd($vaitro);
        // $list = ($vaitro[0]->role)->permissions;
        // dd($res);
        // foreach($res as $item){
        //     dd ($item->ten_vai_tro);
        // }

        $this->v['list'] = $vaitro;
        

        return view('admin.capquyen.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
