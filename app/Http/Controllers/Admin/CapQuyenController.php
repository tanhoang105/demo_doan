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
    protected $v, $vaitrochophep, $vaitro, $user, $chophep;

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
        $vaitro = VaiTro::all();
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
    public function update(Request $request)
    {
        // $this->authorize(mb_strtoupper('update cấp quyền') );

        // dd($request->all());
        $id_vaitro = session('id_vaitro');

        // dd($id_vaitro);
        $params = [];
        $params['cols'] = array_map(function ($item) {
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());

        unset($params['cols']['_token']);
        // dd($params['cols']);

        $quyenTheoVaiTro = VaiTro::find($id_vaitro)->permissions();
        $quyen = $this->chophep->index(null, false, null);
        $this->v['quyen'] = $quyen;
        // dd($params['cols']['cho_phep']);
        $quyenTheoVaiTro->detach();
        // dd($params['cols']['cho_phep']);
        for ($i = 0; $i < count($params['cols']['cho_phep']); $i++) {
        // foreach ($params['cols']['cho_phep']  as $value) {
            // $quyenTheoVaiTro->attach($id_vaitro,  ['cho_phep_id' => $value->cho]);
            $quyenTheoVaiTro->attach($id_vaitro,  ['cho_phep_id' => $params['cols']['cho_phep'][$i]  ]);
        }

        return back();
        // return redirect()->route('route_BE_Admin_Update_Cap_Quyen');
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

    public function detail($id, Request $request)
    {
        session()->put('id_vaitro' ,$id);
        // $this->authorize(mb_strtoupper('xem cấp quyền') );
        
        $vaitro = VaiTro::find($id);
        $this->v['vaitro'] = $vaitro;
        $quyencuavaitro = $vaitro->permissions;



        // dd($q);
        $this->v['q'] = $quyencuavaitro;
        // dd( $this->v['q'][1]->ten);

        // hiển thị những record có trong bản cho phép
        $quyen = $this->chophep->index(null, false, null);
        $this->v['quyen'] = $quyen;
        // dd($quyen);
        // $this->v['tk'] = $tk;

        return view('admin.capquyen.show', $this->v);
    }
}
