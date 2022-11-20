<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for($i=1;$i<=10;$i++){
            $danh_muc[]=[
                'ten_danh_muc'=>'BackEnd'.$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];

            $khoa_hoc[]=[
                'ten_khoa_hoc'=>'Php3'.$i,
                'hinh_anh'=>'1.jpg',
                'mo_ta'=>'laravel',
                'id_danh_muc'=>1,
                'gia_khoa_hoc'=>'400.000',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $lop[]=[
                'ten_lop'=>'123ph'.$i,
                'id_giang_vien'=>$i,
                'id_khoa_hoc'=>$i,
                'ca_thu_id'=>$i,
                'so_luong'=>'40',
                'ngay_bat_dau'=>'2022-10-18',
                'ngay_ket_thuc'=>'2022-10-18',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $ca_hoc[]=[
                'ca_hoc'=>'Ca '.$i,
                'thoi_gian_bat_dau'=>date('H:i:s'),
                'thoi_gian_ket_thuc'=>date('H:i:s'),
                'mo_ta'=>'Mô tả',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $thanh_toan[]=[
                'id_phuong_thuc_thanh_toan'=>$i,
                'ngay_thanh_toan'=>'2022-10-18',
                'gia'=>'100.000',
                'mo_ta'=>'đã thanh toán',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $phuong_thuc_thanh_toan[]=[
                'ten'=>'ten '.$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $hoc_vien[]=[
                'user_id'=>$i,
                'ten_hoc_vien'=>'Tung '.$i,
                'dia_chi'=>'Hà nội '.$i,
                'email'=>'Tung9122002'.$i.'#gmail.com',
                'sdt'=>'0987654321',
                'hinh_anh'=>'1.jpg',
                'gioi_tinh'=>$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $giang_vien[]=[
                'id_user'=>$i,
                'ten_giang_vien'=>'Hoàng thắng',
                'dia_chi'=>'Thạch Thất',
                'email'=>'tung9122002@gmail.com',
                'sdt'=>'907897321',
                'gioi_tinh'=>1,
                'mo_ta'=>'dep trai',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $xep_lop[]=[
                'ngay_dang_ky'=>'2022-10-18',
                'id_lop'=>$i,
           
                
                'id_phong_hoc'=>$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $phong_hoc[]=[
                'ten_phong'=>'Phong '.$i,
                'mo_ta'=>'Phong dep',
                'dia_chi'=>'Hà nội '.$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $dang_ky[]=[
                'ngay_dang_ky'=>'2022-10-18',
                'id_thanh_toan'=>$i,
                'gia'=>'100.000',
                'id_lop'=>$i,
                'id_user'=>$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $khuyen_mai[]=[
                'ma_khuyen_mai'=>'Khóa học hay '.$i,
                'loai_khuyen_mai'=>'1',
                'giam_gia'=>20,
                'mo_ta'=>'Hay lắm',
                'ngay_bat_dau'=>'2022-10-18',
                'ngay_ket_thuc'=>'2022-10-18',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];


        }
        DB::table('danh_muc')->insert($danh_muc);
        DB::table('khoa_hoc')->insert($khoa_hoc);
        DB::table('lop')->insert($lop);
        DB::table('ca_hoc')->insert($ca_hoc);
        DB::table('phong_hoc')->insert($phong_hoc);
        DB::table('xep_lop')->insert($xep_lop);
        DB::table('thanh_toan')->insert($thanh_toan);
        DB::table('phuong_thuc_thanh_toan')->insert($phuong_thuc_thanh_toan);
        DB::table('hoc_vien')->insert($hoc_vien);
        DB::table('giang_vien')->insert($giang_vien);
        DB::table('dang_ky')->insert($dang_ky);
        DB::table('khuyen_mai')->insert($khuyen_mai);
        DB::table('users')->insert([
            'name' => "Poly",
            'email' => 'poly@gmail.com',
            'hinh_anh'=>'1.jpg',
            'sdt'=>'0392725483',
            'dia_chi'=>'Thạch Thất',
            'password' => Hash::make('123456'),
        ]);

        DB::table('vai_tro_cho_phep')->insert([
            'vai_tro_id' => 1,
            'cho_phep_id' => 1,

        ]);
    }
}
