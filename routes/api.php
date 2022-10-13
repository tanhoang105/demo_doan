<?php

use App\Http\Controllers\Admin\KhoahocController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return $request->user();
});
Route::get('/khoa-hoc', [KhoahocController::class, 'index']); // hiển thị danh sách
Route::get('/khoa-hoc/{id}', [KhoahocController::class, 'show']); // hiển thị chi tiết bản ghi
Route::match(['get', 'post'] , '/add-khoa-hoc', [KhoahocController::class , 'create']); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
Route::get('/khoa-hoc-edit/{id}', [KhoahocController::class ,'edit']);