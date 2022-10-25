<?php

use App\Http\Controllers\Admin\CaHocController;
use App\Http\Controllers\Admin\DanhMucKhoaHoc;
use App\Http\Controllers\Admin\KhoahocController;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\Admin\LopController;
use App\Http\Controllers\Admin\XepLopController;
use App\Http\Controllers\Admin\PhongHocController;
use App\Http\Controllers\Admin\VaiTroController;
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

Route::get('/', function () {
    return view('admin.templates.layout');
});

// khóa học
Route::get('/khoa-hoc', [KhoahocController::class, 'index'])->name('route_BE_Admin_Khoa_Hoc'); // hiển thị danh sách
Route::match(['get', 'post'], '/add-khoa-hoc', [KhoahocController::class, 'store'])->name('route_BE_Admin_Add_Khoa_Hoc'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
Route::get('/khoa-hoc-delete/{id}', [KhoahocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Khoa_Hoc');
Route::get('/khoa-hoc-chi-tiet/{id}', [KhoahocController::class, 'edit'])->name('route_BE_Admin_Chi_Tiet_Khoa_Hoc'); // hiển thị chi tiết bản ghi
Route::post('/khoa-hoc-update', [KhoahocController::class, 'update'])->name('route_BE_Admin_Update_Khoa_Hoc');
// khóa học


// xếp lớp

Route::prefix('/xep-lop')->name('route_BE_Admin_')->group(function () {

    Route::get('/', [XepLopController::class, 'index'])->name('Xep_Lop'); // hiển thị danh sách
    Route::get('/xoa/{id}', [XepLopController::class, 'destroy'])->name('Xoa_Xep_Lop');
    Route::get('/edit/{id}', [XepLopController::class, 'edit'])->name('Edit_Xep_Lop');
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