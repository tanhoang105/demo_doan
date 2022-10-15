<?php

use App\Http\Controllers\Admin\DanhMucKhoaHoc;
use App\Http\Controllers\Admin\KhoahocController;
use App\Http\Controllers\Admin\XepLopController;
use App\Http\Controllers\CahocController;
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
Route::get('/khoa-hoc', [KhoahocController::class, 'index']); // hiển thị danh sách
Route::get('/khoa-hoc/{id}', [KhoahocController::class, 'show']); // hiển thị chi tiết bản ghi
Route::match(['get', 'post'], '/add-khoa-hoc', [KhoahocController::class, 'create']); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
Route::get('/khoa-hoc-edit/{id}', [KhoahocController::class, 'edit']);
// khóa học


// xếp lớp
Route::get('/xep-lop', [XepLopController::class, 'index'])->name('route_BE_Admin_Xep_Lop'); // hiển thị danh sách
Route::get('/xep-lop-chi-tiet/{id}', [XepLopController::class, 'show'])->name('route_Admin_BE_Chi_Tiet_Xep_Lop'); // hiển thị danh sách
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
