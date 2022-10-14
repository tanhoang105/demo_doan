<?php

use App\Http\Controllers\Admin\KhoahocController;
use App\Http\Controllers\CahocController;
use Illuminate\Support\Facades\Route;
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
Route::match(['get', 'post'] , '/add-khoa-hoc', [KhoahocController::class , 'create']); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
Route::get('/khoa-hoc-edit/{id}', [KhoahocController::class ,'edit']);
// khóa học


// vai trò
