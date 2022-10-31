<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ChoPhep;
use App\Models\VaiTroNguoiDung;
use App\Models\VaiTroChoPhep;
use App\Models\VaiTro;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //
    protected $table = 'users';
    protected $guarded = [];

//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @var mixed
     */

    public function giangVien()
    {
        return $this->belongsToMany(GiangVien::class);
    }

    public function show($id){
        if($id){
            $res = DB::table($this->table)
                ->where('id' , '=' , $id);
            if(!empty($res)){
                return $res->first();
            }else{
                Session::flash('error' ,"Lỗi");
                return  redirect()->route('route_BE_Admin_Tai_Khoan');
            }
        }
    }

    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query = DB::table($this->table)
                ->where('delete_at', '=', 1)
                ->select($this->table . '.*');
            if (!empty($params['keyword'])) {
                $query = $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.name   ', 'like', '%' . $params['keyword'] . '%');
                    $q->orWhere($this->table . '.dia_chi   ', 'like', '%' . $params['keyword'] . '%');
                    $q->orWhere($this->table . '.email   ', 'like', '%' . $params['keyword'] . '%');

                });
            }

            $list = $query->paginate($perpage);
        } else {
            $query = DB::table($this->table)
                ->where('delete_at', '=', 1)
                ->select($this->table . '.*');
            if (!empty($params['keyword'])) {
                $query = $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.name   ', 'like', '%' . $params['keyword'] . '%');
                    $q->orWhere($this->table . '.dia_chi   ', 'like', '%' . $params['keyword'] . '%');
                    $q->orWhere($this->table . '.email   ', 'like', '%' . $params['keyword'] . '%');

                });
            }
            $list = $query->get();
        }

        return $list;
    }


    public function remove($id)
    {
        if ($id) {
            $res = DB::table($this->table)
                ->where('id', '=', $id);
            $data = [
                'delete_at' => 0
            ];
            $res = $res->update($data);
            return $res;
        }
    }


    public function create($params) {
        if($params){
            $data = array_merge($params['cols'] , [
                'password' => Hash::make($params['cols']['password'])
            ]);
            $res = Db::table($this->table)
                        ->insertGetId($data);
            return $res;
        }
    }


    public function  saveupdate($params){
        if($params){
            $data = array_merge($params['cols'] , [

            ]);

            $res = DB::table($this->table)
                        ->where('id' , '=' , $params['cols']['id'])
                        ->update($data);
            return $res;
        }
    }

    public function role(){

//        return $this->belongsToMany(VaiTro::class , 'vai_tro_nguoi_dung');

        // dung
          return $this->belongsTo(VaiTro::class , 'vai_tro_id');

    }



    public  function  HasVaiTro($choPhep){



        // lấy ra tất cả vai trò theo tài khoản user
//        $role = $this->role;

//
//        foreach ($role as $v){
//            echo '<pre>';
//            echo $v->ten_vai_tro;
//            echo '<pre>';
//            echo($choPhep);
//            echo '<pre>';
////            return !!($v->permissions);
//            $res = !! optional(optional(($v->permissions))->contains($choPhep));
//           echo !!$res;
////            if($res == []){
////                dd($res);
//////                return 0;
////            }
////            return !! optional(optional(($v->permissions))->contains($choPhep));
////
//
//        }
//        dd($this->role);
        return !! optional(optional($this->role)->permissions)->contains($choPhep);

    }



}
