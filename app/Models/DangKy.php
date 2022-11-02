<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DangKy extends Model
{
    use HasFactory;
    protected $table="dang_ky";
    public function saveNew($params){
        // dd($data);
        $res=DB::table('dang_ky')
            ->insertGetId($params);
        return $res;
    }
}
