<?php

use App\Http\Controllers\Admin\DanhMucKhoaHoc;
use App\Http\Controllers\Admin\KhoahocController;
use App\Http\Controllers\Admin\XepLopController;
use App\Http\Controllers\CahocController;
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
Route::get('/xep-lop', [XepLopController::class, 'index'])->name('route_BE_Admin_Xep_Lop'); // hiển thị danh sách
Route::get('/xep-lop-xoa/{id}', [XepLopController::class, 'destroy'])->name('route_Admin_BE_Xoa_Xep_Lop');
Route::get('/xep-lop-edit/{id}', [XepLopController::class, 'edit'])->name('route_Admin_BE_Edit_Xep_Lop');
Route::post('/xep-lop-update', [XepLopController::class, 'update'])->name('route_Admin_BE_Update_Xep_Lop');
Route::match(['get', 'post'], '/add', [XepLopController::class, 'create'])->name('route_Admin_BE_Add_Xep_Lop');


// danh muc khoa hoc
Route::get('/danh-muc', [DanhMucKhoaHoc::class, 'index'])->name('route_BE_Admin_Danh_Muc_Khoa_Hoc'); // hiển thị danh sách
Route::match( ['get' , 'post'],'/danh-muc-add', [DanhMucKhoaHoc::class, 'store'])->name('route_Admin_BE_Add_Danh_Muc'); // hiển thị danh sách
Route::get('/danh-muc-edit/{id}', [DanhMucKhoaHoc::class, 'edit'])->name('route_Admin_BE_Edit_Danh_Muc'); // hiển thị danh sách
Route::post('/danh-muc-update', [DanhMucKhoaHoc::class, 'update'])->name('route_Admin_BE_Update_Danh_Muc'); // hiển thị danh sách
Route::get('/danh-muc-xoa/{id}', [DanhMucKhoaHoc::class, 'destroy'])->name('route_Admin_BE_Xoa_Danh_Muc'); // hiển thị danh sách


// phòng học
Route::get('/phong-hoc', [PhongHocController::class, 'index'])->name('route_BE_Admin_Phong_Hoc');
Route::match(['get', 'post'] ,'/phong-hoc-add' , [PhongHocController::class , 'store'])->name('route_BE_Admin_Add_Phong_Hoc');
Route::get('/phong-hoc-edit/{id}', [PhongHocController::class, 'edit'])->name('route_BE_Admin_Edit_Phong_Hoc');
Route::post('/phong-hoc-update', [PhongHocController::class, 'update'])->name('route_BE_Admin_Update_Phong_Hoc');
Route::get('/phong-hoc-xoa/{id}', [PhongHocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Phong_Hoc');


// vai tro 
Route::get('vai-tro' , [VaiTroController::class , 'index'])->name('route_BE_Admin_Vai_Tro');
Route::get('vai-tro-edit/{id}' , [VaiTroController::class , 'edit'])->name('route_BE_Admin_Edit_Vai_Tro');
Route::post('vai-tro-update' , [VaiTroController::class , 'update'])->name('route_BE_Admin_Update_Vai_Tro');
Route::get('vai-tro-xoa/{id}' , [VaiTroController::class , 'destroy'])->name('route_BE_Admin_Xoa_Vai_Tro');
Route::match(['get' , 'post'] , 'vai-tro-add', [VaiTroController::class , 'store'])->name('route_BE_Admin_Add_Vai_Tro');
