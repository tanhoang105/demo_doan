<?php

use App\Http\Controllers\Admin\CaHocController;
use App\Http\Controllers\Admin\DangKyController;
use App\Http\Controllers\Admin\DanhMucKhoaHoc;
use App\Http\Controllers\Admin\GiangVienController;
use App\Http\Controllers\Admin\HocVienController;
use App\Http\Controllers\Admin\KhoahocController;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\Admin\LopController;
use App\Http\Controllers\Admin\PhanQuyenController;
use App\Http\Controllers\Admin\XepLopController;
use App\Http\Controllers\Admin\PhongHocController;
use App\Http\Controllers\Admin\PhuongThucThanhToan;
use App\Http\Controllers\Admin\VaiTroController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Resources\LopCollection;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Route;
use LDAP\ResultEntry;
use Symfony\Component\Routing\RouterInterface;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('/coures', [\App\Http\Controllers\Client\KhoaHocController::class, 'index'])->name('client_khoa_hoc');
Route::get('/lien-he', [\App\Http\Controllers\Client\LienHeController::class, 'index'])->name('client_lien_he');
Route::get('/giang-vien', [\App\Http\Controllers\Client\GiangVienController::class, 'index'])->name('client_giang_vien');
Route::get('/gioi-thieu', [\App\Http\Controllers\Client\GioiThieuController::class, 'index'])->name('client_gioi_thieu');
Route::get('/chi-tiet-khoa-hoc/{id}', [\App\Http\Controllers\Client\KhoaHocController::class, 'chiTietKhoaHoc'])->name('client_chi_tiet_khoa_hoc');
Route::get('/chi-tiet-giang-vien/{id}', [\App\Http\Controllers\Client\GiangVienController::class, 'chiTietGiangVien'])->name('client_chi_tiet_giang_vien');
Route::get('/dang-ky', [\App\Http\Controllers\Client\DangKyController::class, 'loadDangKy'])->name('client_dang_ky');
Route::post('/dang-ky', [\App\Http\Controllers\Client\DangKyController::class, 'postDangKy'])->name('client_post_dang_ky');
// Route::get('/dang-ky', [\App\Http\Controllers\Client\DangKyController::class, 'index'])->name('client_dang_ky_khoa_hoc');

Route::prefix('/admin')->group(function () {

    // khóa học
    Route::get('/khoa-hoc', [KhoahocController::class, 'index'])->name('route_BE_Admin_Khoa_Hoc'); // hiển thị danh sách
    Route::match(['get', 'post'], '/add-khoa-hoc',   [KhoahocController::class, 'store'])->name('route_BE_Admin_Add_Khoa_Hoc'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
    Route::get('/khoa-hoc-delete/{id}', [KhoahocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Khoa_Hoc');
    Route::get('/khoa-hoc-chi-tiet/{id}', [KhoahocController::class, 'edit'])->name('route_BE_Admin_Chi_Tiet_Khoa_Hoc'); // hiển thị chi tiết bản ghi
    Route::post('/khoa-hoc-update', [KhoahocController::class, 'update'])->name('route_BE_Admin_Update_Khoa_Hoc');
    // khóa học


    // đăng ký 
    Route::prefix('/dang-ky')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [DangKyController::class, 'index'])->name('List_Dang_Ky'); // hiển thị danh sách
        // Route::match(['get', 'post'], '/add-khoa-hoc',   [DangKyController::class, 'store'])->name('Add_Giang_Vien'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/dang-ky-delete/{id}', [DangKyController::class, 'destroy'])->name('Xoa_Giang_Vien');
        Route::get('/dang-ky-edit/{id}', [DangKyController::class, 'edit'])->name('Edit_Dang_Ky'); // hiển thị chi tiết bản ghi
        Route::post('/dang-ky-update', [DangKyController::class, 'update'])->name('Update_Dang_Ky');
    });
    // giảng viên
    Route::prefix('/giang-vien')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [GiangVienController::class, 'index'])->name('List_Giang_Vien'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-khoa-hoc',   [GiangVienController::class, 'store'])->name('Add_Giang_Vien'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/giang-vien-delete/{id}', [GiangVienController::class, 'destroy'])->name('Xoa_Giang_Vien');
        Route::get('/giang-vien-edit/{id}', [GiangVienController::class, 'edit'])->name('Edit_Giang_Vien'); // hiển thị chi tiết bản ghi
        Route::post('/giang-vien-update', [GiangVienController::class, 'update'])->name('Update_Giang_Vien');
    });

    Route::prefix('/phan-quyen')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [PhanQuyenController::class, 'index'])->name('List_Quyen'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-quyen',   [PhanQuyenController::class, 'store'])->name('Add_Quyen'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/quyen-delete/{id}', [PhanQuyenController::class, 'destroy'])->name('Xoa_Quyen');
        Route::get('/quyen-edit/{id}', [PhanQuyenController::class, 'edit'])->name('Edit_Quyen'); // hiển thị chi tiết bản ghi
        Route::post('/quyen-update', [PhanQuyenController::class, 'update'])->name('Update_Quyen');
    });


    // học viên

    Route::prefix('/hoc-vien')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [HocVienController::class, 'index'])->name('List_Hoc_Vien'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-khoa-hoc',   [HocVienController::class, 'store'])->name('Add_Hoc_Vien'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/hoc-vien-delete/{id}', [HocVienController::class, 'destroy'])->name('Xoa_Hoc_Vien');
        Route::get('/hoc-vien-edit/{id}', [HocVienController::class, 'edit'])->name('Edit_Hoc_Vien'); // hiển thị chi tiết bản ghi
        Route::post('/hoc-vien-update', [HocVienController::class, 'update'])->name('Update_Hoc_Vien');
    });



    // xếp lớp

    Route::prefix('/xep-lop')->name('route_BE_Admin_')->group(function () {

        Route::get('/', [XepLopController::class, 'index'])->name('Xep_Lop'); // hiển thị danh sách
        Route::get('/xoa/{id}', [XepLopController::class, 'destroy'])->name('Xoa_Xep_Lop');
        Route::get('/edit/{id}', [XepLopController::class, 'edit'])->name('Edit_Xep_Lop');
        Route::get('/detail-lop/{id_xep_lop}', [LopController::class, 'show'])->name('Detail_Xep_Lop');
        Route::post('/update', [XepLopController::class, 'update'])->name('Update_Xep_Lop');
        Route::match(['get', 'post'], '/add', [XepLopController::class, 'store'])->name('Add_Xep_Lop');
    });


    // danh muc khoa hoc
    Route::get('/danh-muc', [DanhMucKhoaHoc::class, 'index'])->name('route_BE_Admin_Danh_Muc_Khoa_Hoc'); // hiển thị danh sách
    Route::match(['get', 'post'], '/danh-muc-add', [DanhMucKhoaHoc::class, 'store'])->name('route_Admin_BE_Add_Danh_Muc'); // hiển thị danh sách
    Route::get('/danh-muc-edit/{id}', [DanhMucKhoaHoc::class, 'edit'])->name('route_Admin_BE_Edit_Danh_Muc'); // hiển thị danh sách
    Route::post('/danh-muc-update', [DanhMucKhoaHoc::class, 'update'])->name('route_Admin_BE_Update_Danh_Muc'); // hiển thị danh sách
    Route::get('/danh-muc-xoa/{id}', [DanhMucKhoaHoc::class, 'destroy'])->name('route_Admin_BE_Xoa_Danh_Muc'); // hiển thị danh sách


    // phòng học
    Route::get('/phong-hoc', [PhongHocController::class, 'index'])->name('route_BE_Admin_Phong_Hoc');
    Route::match(['get', 'post'], '/phong-hoc-add', [PhongHocController::class, 'store'])->name('route_BE_Admin_Add_Phong_Hoc');
    Route::get('/phong-hoc-edit/{id}', [PhongHocController::class, 'edit'])->name('route_BE_Admin_Edit_Phong_Hoc');
    Route::post('/phong-hoc-update', [PhongHocController::class, 'update'])->name('route_BE_Admin_Update_Phong_Hoc');
    Route::get('/phong-hoc-xoa/{id}', [PhongHocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Phong_Hoc');


    // vai tro
    Route::get('vai-tro', [VaiTroController::class, 'index'])->name('route_BE_Admin_Vai_Tro');
    Route::get('vai-tro-edit/{id}', [VaiTroController::class, 'edit'])->name('route_BE_Admin_Edit_Vai_Tro');
    Route::post('vai-tro-update', [VaiTroController::class, 'update'])->name('route_BE_Admin_Update_Vai_Tro');
    Route::get('vai-tro-xoa/{id}', [VaiTroController::class, 'destroy'])->name('route_BE_Admin_Xoa_Vai_Tro');
    Route::match(['get', 'post'], 'vai-tro-add', [VaiTroController::class, 'store'])->name('route_BE_Admin_Add_Vai_Tro');


    // lớp học
    Route::prefix('lop-hop')->name('route_BE_Admin_')->group(function () {

        Route::get('/list', [LopController::class, 'index'])->name('List_Lop');
        Route::get('/xoa/{id}', [LopController::class, 'destroy'])->name('Xoa_Lop');
        Route::get('/edit/{id}', [LopController::class, 'edit'])->name('Edit_Lop');
        Route::post('/update', [LopController::class, 'update'])->name('Update_Lop');
        Route::match(['get', 'post'], '/add', [LopController::class, 'store'])->name('Add_Lop');
    });

    // ca học
    Route::prefix('/ca-hoc')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [CaHocController::class, 'index'])->name('Ca_Hoc');
        Route::get('/xoa/{id}', [CaHocController::class, 'destroy'])->name('Xoa_Ca_Hoc');
        Route::get('/edit/{id}', [CaHocController::class, 'edit'])->name('Edit_Ca_Hoc');
        Route::post('/update', [CaHocController::class, 'update'])->name('Update_Ca_Hoc');
        Route::match(['get', 'post'], '/add', [CaHocController::class, 'store'])->name('Add_Ca_Hoc');
    });

    //khuyến mại
    Route::prefix('/khuyen-mai')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [KhuyenMaiController::class, 'index'])->name('Khuyen_Mai');
        Route::get('/xoa/{id}', [KhuyenMaiController::class, 'destroy'])->name('Xoa_Khuyen_Mai');
        Route::get('/edit/{id}', [KhuyenMaiController::class, 'edit'])->name('Edit_Khuyen_Mai');
        Route::post('/update', [KhuyenMaiController::class, 'update'])->name('Update_Khuyen_Mai');
        Route::match(['get', 'post'], '/add', [KhuyenMaiController::class, 'store'])->name('Add_Khuyen_Mai');
    });


    //khuyến mại
    Route::prefix('/phuong-thuc-thanh-toan')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [PhuongThucThanhToan::class, 'index'])->name('Phuong_Thuc_Thanh_Toan');
        Route::get('/xoa/{id}', [PhuongThucThanhToan::class, 'destroy'])->name('Xoa_Phuong_Thuc_Thanh_Toan');
        Route::get('/edit/{id}', [PhuongThucThanhToan::class, 'edit'])->name('Edit_Phuong_Thuc_Thanh_Toan');
        Route::post('/update', [PhuongThucThanhToan::class, 'update'])->name('Update_Phuong_Thuc_Thanh_Toan');
        Route::match(['get', 'post'], '/add', [PhuongThucThanhToan::class, 'store'])->name('Add_Phuong_Thuc_Thanh_Toan');
    });


    // admin quản lý tài khoản

    Route::prefix('/tai-khoan')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'index'])->name('Tai_Khoan');
        Route::get('/xoa/{id}', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'destroy'])->name('Xoa_Tai_Khoan');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'edit'])->name('Edit_Tai_Khoan');
        Route::post('/update', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'update'])->name('Update_Tai_Khoan');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'store'])->name('Add_Tai_Khoan');
    });
});


// client đăng ký hoặc đăng nhập tài khoản
Route::match(['post', 'get'], '/login', [\App\Http\Controllers\Auth\AuthController::class, 'store'])->name('route_FE_Client_Login');
// auth
Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/loginForm', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/getdangki', [AuthController::class, 'getdangki'])->name('getdangki');
    Route::post('/store', [AuthController::class, 'store'])->name('store');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
