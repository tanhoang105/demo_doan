<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoimatkhauRequest;
use App\Models\User;
use App\Models\XepLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ThongTinController extends Controller
{

    public function index(Request $request) {
        return view('client.thong-tin-ca-nhan.index');
    }

    public function update(Request $request) {
        $id = Auth::user()->id;
        $params = [];
        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->post());
        //            dd($id);
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        if ($request->file('hinh_anh')) {

            $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
        }

        if ($request->input('password')) {
            $params['cols']['password'] = Hash::make($params['cols']['password']);
        } else {
            unset($params['cols']['password']);
        }
        $modelUsers = new User();
        $res  = $modelUsers->saveupdate($params);
        if ($res > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('client_thong_tin_ca_nhan');
        } else {
            Session::flash('error', 'Cập nhập không thành công');
            return redirect()->route('client_thong_tin_ca_nhan');
        }
    }

    public  function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageTaiKhoan', $filename,  'public');
    }

    public function change_password() {
        return view('client.thong-tin-ca-nhan.doi-mat-khau');
    }

    public function update_password(DoimatkhauRequest $request) {
        $curent_user = Auth::user();
        if(Hash::check($request->old_password,$curent_user->password)) {
            $curent_user->update([
                'password' => bcrypt($request->new_password)
            ]);
            return redirect()->back()->with('success','Cập nhật thành công');
        } else {
            return redirect()->back()->with('error','Cập nhật không thành công vui lòng thử lại');
        }

    }
}
