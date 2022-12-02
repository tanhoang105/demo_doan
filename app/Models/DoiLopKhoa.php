<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoiLopKhoa extends Model
{
    use HasFactory;
    protected $table = 'doi_lop_khoa';
    protected $guarded = [];
    public function scopeSearch($query) {
        if($key = request()->search){
            $query = $query->where('id_user','like', '%'.$key.'%');
        }
        // dd($query);
        return $query;
    }
}
