<?php

use App\Http\Controllers\Admin\KhoahocController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
});
Route::get('/khoa-hoc', [\App\Http\Controllers\Api\KhoaHocController::class, 'index']); // hiển thị danh sách
Route::get('/khoa-hoc/{id}', [KhoahocController::class, 'show']); // hiển thị chi tiết bản ghi
Route::match(['get', 'post'] , '/add-khoa-hoc', [KhoahocController::class , 'create']); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
Route::get('/khoa-hoc-edit/{id}', [KhoahocController::class ,'edit']);


Route::get('/danh-muc', [\App\Http\Controllers\Api\DanhMucController::class, 'index']); // hiển thị danh sách
Route::get('/lop', [\App\Http\Controllers\Api\LopController::class, 'index']);
Route::get('/user', [\App\Http\Controllers\Api\UserController::class, 'index']);
Route::get('/phong-hoc',[\App\Http\Controllers\Api\PhongHocController::class,'index']);
Route::get('/hoc-vien',[\App\Http\Controllers\Api\HocVienController::class,'index']);
Route::get('/giang-vien',[\App\Http\Controllers\Api\GiangVienController::class,'index']);
Route::get('/xep-lop',[\App\Http\Controllers\Api\XepLopController::class,'index']);
Route::get('/dang-ky',[\App\Http\Controllers\Api\DangKyController::class,'index']);
Route::get('/thanh-toan',[\App\Http\Controllers\Api\ThanhToanController::class,'index']);
Route::get('/ca-hoc',[\App\Http\Controllers\Api\CaHocController::class,'index']);
Route::get('/khuyen-mai',[\App\Http\Controllers\Api\KhuyenMaiController::class,'index']);

