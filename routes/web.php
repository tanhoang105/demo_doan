<?php

use App\Http\Controllers\Admin\CaHocController;
use App\Http\Controllers\Admin\CapQuyenController;
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
use App\Http\Controllers\Admin\TaiKhoanController;
use App\Http\Controllers\Admin\VaiTroController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CaThuController;
use App\Http\Controllers\Admin\ThanhToanController;
use App\Http\Controllers\Admin\ThuHocController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DoiLopKhoaController;
use App\Http\Requests\XeplopRequest;
use App\Http\Resources\LopCollection;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Route;
//use LDAP\ResultEntry;
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
Route::get('/dang-nhap', [\App\Http\Controllers\Auth\AuthController::class, 'index'])->name('client_dang_nhap');
Route::get('/chi-tiet-khoa-hoc/{id}', [\App\Http\Controllers\Client\KhoaHocController::class, 'chiTietKhoaHoc'])->name('client_chi_tiet_khoa_hoc');
Route::get('/chi-tiet-giang-vien/{id}', [\App\Http\Controllers\Client\GiangVienController::class, 'chiTietGiangVien'])->name('client_chi_tiet_giang_vien');
Route::get('check-email',[\App\Http\Controllers\Client\DangKyController::class,'checkEmail'])->name('client_check_email');
Route::get('/loc-khoa-hoc',[\App\Http\Controllers\Client\KhoaHocController::class,'locKhoaHoc'])->name('loc_khoa_hoc');

Route::get('/dang-ky/{id?}', [\App\Http\Controllers\Client\DangKyController::class, 'loadDangKy'])->name('client_dang_ky');
Route::post('/dang-ky/{id?}', [\App\Http\Controllers\Client\DangKyController::class, 'postDangKy'])->name('client_post_dang_ky');
Route::get('complete-dangky/{code}', [\App\Http\Controllers\Client\DangKyController::class, 'completeDangKy'])->name('client_complete_dang_ky');
// Route::get('/chi-tiet-giang-vien', [\App\Http\Controllers\Client\GiangVienController::class, 'chiTietGiangVien'])->name('client_chi_tiet_giang_vien');
Route::get('/thong-tin-ca-nhan', [\App\Http\Controllers\Client\ThongTinController::class, 'index'])->name('client_thong_tin_ca_nhan');
Route::get('IPN', [\App\Http\Controllers\Client\ThanhToanController::class, 'IPN'])->name('complete_pay');
Route::get('payment', [\App\Http\Controllers\Client\ThanhToanController::class, 'payment'])->name('getPayment');
Route::post('vnp_payment/{id}', [\App\Http\Controllers\Client\ThanhToanController::class, 'vnpPayment'])->name('payment');
Route::get('lich-su-dang-ky/{id}', [\App\Http\Controllers\Client\DangKyController::class, 'lichsuDangKy'])->name('client_lich_su_dang_ky');
Route::get('IPN', [\App\Http\Controllers\Client\ThanhToanController::class, 'IPN'])->name('complete_pay');
Route::get('vnp-return', [\App\Http\Controllers\Client\ThanhToanController::class, 'resultPay'])->name('result_pay');

// Route::get('/chi-tiet-giang-vien', [\App\Http\Controllers\Client\GiangVienController::class, 'chiTietGiangVien'])->name('client_chi_tiet_giang_vien');
Route::get('/thong-tin-ca-nhan', [\App\Http\Controllers\Client\ThongTinController::class, 'index'])->name('client_thong_tin_ca_nhan');
Route::get('/lop', [\App\Http\Controllers\Client\LopController::class, 'index'])->name('client_lop');
Route::get('/form_doi_lop/{id}', [\App\Http\Controllers\Client\LopController::class, 'form_doi_lop'])->name('form_doi_lop');
Route::post('/doi_lop', [\App\Http\Controllers\Client\LopController::class, 'doi_lop'])->name('doi_lop');
//lich_hoc 
Route::get('/lich-hoc', [\App\Http\Controllers\Client\LichHocController::class, 'index'])->name('client_lich_hoc');
//doi khoa_hoc
Route::get('/khoa_hoc', [\App\Http\Controllers\Client\KhoaHocController::class, 'khoa_hoc'])->name('khoa_hoc_dang_ki');
Route::get('/get_khoa_hoc', [\App\Http\Controllers\Client\KhoaHocController::class, 'get_khoa_hoc'])->name('get_khoa_hoc');
Route::get('/form_doi_khoa/{id}', [\App\Http\Controllers\Client\KhoaHocController::class, 'form_doi_khoa'])->name('form_doi_khoa');
Route::post('/doi_khoa_hoc', [\App\Http\Controllers\Client\KhoaHocController::class, 'doi_khoa_hoc'])->name('doi_khoa_hoc');
// tk ghi no
Route::get('/tk_ghi_no', [\App\Http\Controllers\GhiNoController::class, 'tk_ghi_no'])->name('tk_ghi_no');
// hiển thị khóa theo lớp
Route::get('listLop', [DangKyController::class, 'listDangKy'])->name('admin_dang_ky');

Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.trangchu');
    });
    Route::prefix('/doi-lop')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [DoiLopKhoaController::class, 'index'])->name('danh_sach_doi_lop');
        // Route::get('/xoa/{id}', [DoiLopKhoaController::class, 'destroy'])->name('Xoa_Ca_Hoc');
        // Route::get('/edit/{id}', [DoiLopKhoaController::class, 'edit'])->name('Edit_Ca_Hoc');
        Route::put('/updateStatus/{doilop}', [DoiLopKhoaController::class, 'updateStatus'])->name('updateStatus_doilop');
        Route::match(['get', 'post'], '/add', [DoiLopKhoaController::class, 'store'])->name('Add_Ca_Hoc');
        Route::post('xoa-all', [DoiLopKhoaController::class, 'destroyAll'])->name('Xoa_All_Ca_Hoc');
    });

    Route::prefix('/ca-hoc')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [CaHocController::class, 'index'])->name('Ca_Hoc');
        Route::get('/xoa/{id}', [CaHocController::class, 'destroy'])->name('Xoa_Ca_Hoc');
        Route::get('/edit/{id}', [CaHocController::class, 'edit'])->name('Edit_Ca_Hoc');
        Route::post('/update', [CaHocController::class, 'update'])->name('Update_Ca_Hoc');
        Route::match(['get', 'post'], '/add', [CaHocController::class, 'store'])->name('Add_Ca_Hoc');
        Route::post('xoa-all', [CaHocController::class, 'destroyAll'])->name('Xoa_All_Ca_Hoc');
    });

    // khóa học
    Route::prefix('/khoa-hoc')->name('route_BE_Admin_')->group(function () {

        Route::get('/', [KhoahocController::class, 'index'])->name('Khoa_Hoc'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-khoa-hoc',   [KhoahocController::class, 'store'])->name('Add_Khoa_Hoc'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/khoa-hoc-delete/{id}', [KhoahocController::class, 'destroy'])->name('Xoa_Khoa_Hoc');
        Route::get('/khoa-hoc-chi-tiet/{id}', [KhoahocController::class, 'edit'])->name('Chi_Tiet_Khoa_Hoc'); // hiển thị chi tiết bản ghi
        Route::post('/khoa-hoc-update', [KhoahocController::class, 'update'])->name('Update_Khoa_Hoc');
        Route::post('/khoa-hoc-xoa-all', [KhoahocController::class, 'destroyAll'])->name('Xoa_All_Khoa_Hoc');
    });



    // đăng ký
    Route::prefix('/dang-ky')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [DangKyController::class, 'index'])->name('List_Dang_Ky'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-dang-ky',   [DangKyController::class, 'store'])->name('Add_Dang_Ky'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/dang-ky-delete/{id}', [DangKyController::class, 'destroy'])->name('Xoa_Giang_Vien');
        Route::get('/dang-ky-edit/{id}', [DangKyController::class, 'edit'])->name('Edit_Dang_Ky'); // hiển thị chi tiết bản ghi
        Route::post('/dang-ky-update', [DangKyController::class, 'update'])->name('Update_Dang_Ky');
        Route::post('xoa-all', [DangKyController::class, 'destroyAll'])->name('Xoa_All_Dang_Ky');
    });



    // thứ học 
    Route::prefix('/thu-hoc')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [ThuHocController::class, 'index'])->name('List_Thu_Hoc'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-thu-hoc',   [ThuHocController::class, 'store'])->name('Add_Thu_Hoc'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/delete/{id}', [ThuHocController::class, 'destroy'])->name('Xoa_Thu_Hoc');
        Route::get('/edit/{id}', [ThuHocController::class, 'edit'])->name('Edit_Thu_Hoc'); // hiển thị chi tiết bản ghi
        Route::post('/update', [ThuHocController::class, 'update'])->name('Update_Thu_Hoc');
        Route::post('xoa-all', [ThuHocController::class, 'destroyAll'])->name('Xoa_All_Thu_Hoc');
    });



    // giảng viên
    Route::prefix('/giang-vien')->name('route_BE_Admin_')->group(function () {
        Route::post('xoa-all', [GiangVienController::class, 'destroyAll'])->name('Xoa_All_Giang_Vien');
        Route::get('/', [GiangVienController::class, 'index'])->name('List_Giang_Vien'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-khoa-hoc',   [GiangVienController::class, 'store'])->name('Add_Giang_Vien'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/giang-vien-delete/{id}', [GiangVienController::class, 'destroy'])->name('Xoa_Giang_Vien');
        Route::get('/giang-vien-edit/{id}', [GiangVienController::class, 'edit'])->name('Edit_Giang_Vien'); // hiển thị chi tiết bản ghi
        Route::post('/giang-vien-update', [GiangVienController::class, 'update'])->name('Update_Giang_Vien');
    });


    Route::prefix('/ca-thu')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [CaThuController::class, 'index'])->name('List_Ca_Thu');
        Route::post('xoa-all', [CaThuController::class, 'destroyAll'])->name('Xoa_All_Ca_Thu');
        Route::match(['get', 'post'], '/add',   [CaThuController::class, 'store'])->name('Add_Ca_Thu'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/delete/{id}', [CaThuController::class, 'destroy'])->name('Xoa_Ca_Thu');
        Route::get('/edit/{id}', [CaThuController::class, 'edit'])->name('Edit_Ca_Thu'); // hiển thị chi tiết bản ghi
        Route::post('/update', [CaThuController::class, 'update'])->name('Update_Ca_Thu');
        Route::get('/show', [CaThuController::class, 'show'])->name('Show_Ca_Thu');
    });


    // thanh toán
    Route::prefix('/thanh-toan')->name('route_BE_Admin_')->group(function () {
        Route::post('xoa-all', [ThanhToanController::class, 'destroyAll'])->name('Xoa_All_Thanh_Toan');
        Route::get('/', [ThanhToanController::class, 'index'])->name('List_Thanh_Toan'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-thanh-toan',   [ThanhToanController::class, 'store'])->name('Add_Thanh_Toan'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/delete/{id}', [ThanhToanController::class, 'destroy'])->name('Xoa_Thanh_Toan');
        Route::get('/edit/{id}', [ThanhToanController::class, 'edit'])->name('Edit_Thanh_Toan'); // hiển thị chi tiết bản ghi
        Route::post('/update', [ThanhToanController::class, 'update'])->name('Update_Thanh_Toan');
        Route::get('/in-hoa-don/{id}', [ThanhToanController::class, 'inHoaDon'])->name('In_Hoa_Don');
    });


    // phần này là hiển thị ra những quyền mà tài khoản có thể đc phân (table - chophep)
    Route::prefix('/phan-quyen')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [PhanQuyenController::class, 'index'])->name('List_Quyen'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-quyen',   [PhanQuyenController::class, 'store'])->name('Add_Quyen'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/quyen-delete/{id}', [PhanQuyenController::class, 'destroy'])->name('Xoa_Quyen');
        Route::get('/quyen-edit/{id}', [PhanQuyenController::class, 'edit'])->name('Edit_Quyen'); // hiển thị chi tiết bản ghi
        Route::post('/quyen-update', [PhanQuyenController::class, 'update'])->name('Update_Quyen');
    });

    // phần này là hiển thị ra tất cả tài khoản và quyền của tài khỏa đó (table - vaitrochophep)

    Route::prefix('/cap-quyen')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [CapQuyenController::class, 'index'])->name('List_Cap_Quyen'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-cap-quyen',   [CapQuyenController::class, 'store'])->name('Add_Cap_Quyen'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/cap-quyen-delete/{id}', [CapQuyenController::class, 'destroy'])->name('Xoa_Cap_Quyen');
        Route::get('/cap-quyen-edit/{id}', [CapQuyenController::class, 'edit'])->name('Edit_Cap_Quyen'); // hiển thị chi tiết bản ghi
        Route::post('/update', [CapQuyenController::class, 'update'])->name('Update_Cap_Quyen');
        Route::post('/cap-quyen-xoa-all', [CapQuyenController::class, 'destroyAll'])->name('Xoa_All_Cap_Quyen');
        Route::get('/cap-quyen-detail/{id}', [CapQuyenController::class, 'detail'])->name('Detail_Cap_Quyen');
    });

    // học viên

    Route::prefix('/hoc-vien')->name('route_BE_Admin_')->group(function () {
        Route::get('/', [HocVienController::class, 'index'])->name('List_Hoc_Vien'); // hiển thị danh sách
        Route::match(['get', 'post'], '/add-khoa-hoc',   [HocVienController::class, 'store'])->name('Add_Hoc_Vien'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
        Route::get('/hoc-vien-delete/{id}', [HocVienController::class, 'destroy'])->name('Xoa_Hoc_Vien');
        Route::get('/hoc-vien-edit/{id}', [HocVienController::class, 'edit'])->name('Edit_Hoc_Vien'); // hiển thị chi tiết bản ghi
        Route::post('/hoc-vien-update', [HocVienController::class, 'update'])->name('Update_Hoc_Vien');
        Route::post('xoa-all', [HocVienController::class, 'destroyAll'])->name('Xoa_All_Hoc_Vien');
    });



    // xếp lớp

    Route::prefix('/xep-lop')->name('route_BE_Admin_')->group(function () {

        Route::get('/', [XepLopController::class, 'index'])->name('Xep_Lop'); // hiển thị danh sách
        Route::get('/xoa/{id}', [XepLopController::class, 'destroy'])->name('Xoa_Xep_Lop');
        Route::get('/edit/{id}', [XepLopController::class, 'edit'])->name('Edit_Xep_Lop');
        Route::get('/detail-lop/{id_xep_lop}', [LopController::class, 'show'])->name('Detail_Xep_Lop');
        Route::post('/update', [XepLopController::class, 'update'])->name('Update_Xep_Lop');
        Route::match(['get', 'post'], '/add', [XepLopController::class, 'store'])->name('Add_Xep_Lop');
        Route::post('xoa-all', [XepLopController::class, 'destroyAll'])->name('Xoa_All_Xep_Lop');
    });


    // danh muc khoa hoc
    Route::prefix('danh-muc')->name('route_Admin_BE_')->group(function () {

        Route::get('/', [DanhMucKhoaHoc::class, 'index'])->name('Danh_Muc_Khoa_Hoc'); // hiển thị danh sách
        Route::match(['get', 'post'], '/danh-muc-add', [DanhMucKhoaHoc::class, 'store'])->name('Add_Danh_Muc'); // hiển thị danh sách
        Route::get('/danh-muc-edit/{id}', [DanhMucKhoaHoc::class, 'edit'])->name('Edit_Danh_Muc'); // hiển thị danh sách
        Route::post('/danh-muc-update', [DanhMucKhoaHoc::class, 'update'])->name('Update_Danh_Muc'); // hiển thị danh sách
        Route::get('/danh-muc-xoa/{id}', [DanhMucKhoaHoc::class, 'destroy'])->name('Xoa_Danh_Muc'); // hiển thị danh sách
        Route::post('/xoa-all', [DanhMucKhoaHoc::class, 'destroyAll'])->name('Xoa_All_Danh_Muc');
    });


    // phòng học
    Route::get('/phong-hoc', [PhongHocController::class, 'index'])->name('route_BE_Admin_Phong_Hoc');
    Route::match(['get', 'post'], '/phong-hoc-add', [PhongHocController::class, 'store'])->name('route_BE_Admin_Add_Phong_Hoc');
    Route::get('/phong-hoc-edit/{id}', [PhongHocController::class, 'edit'])->name('route_BE_Admin_Edit_Phong_Hoc');
    Route::post('/phong-hoc-update', [PhongHocController::class, 'update'])->name('route_BE_Admin_Update_Phong_Hoc');
    Route::get('/phong-hoc-xoa/{id}', [PhongHocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Phong_Hoc');
    Route::post('xoa-all', [PhongHocController::class, 'destroyAll'])->name('route_BE_Admin_Xoa_All_Phong_Hoc');


    // vai tro

    Route::prefix('/vai-tro')->name('route_BE_Admin_')->group(function () {

        Route::get('/', [VaiTroController::class, 'index'])->name('Vai_Tro');
        Route::get('vai-tro-edit/{id}', [VaiTroController::class, 'edit'])->name('Edit_Vai_Tro');
        Route::post('vai-tro-update', [VaiTroController::class, 'update'])->name('Update_Vai_Tro');
        Route::get('vai-tro-xoa/{id}', [VaiTroController::class, 'destroy'])->name('Xoa_Vai_Tro');
        Route::match(['get', 'post'], 'vai-tro-add', [VaiTroController::class, 'store'])->name('Add_Vai_Tro');
        Route::post('xoa-all', [VaiTroController::class, 'destroyAll'])->name('Xoa_All_Vai_Tro');
    });


    // lớp học
    Route::prefix('lop-hop')->name('route_BE_Admin_')->group(function () {

        Route::get('/list', [LopController::class, 'index'])->name('List_Lop');
        Route::get('/xoa/{id}', [LopController::class, 'destroy'])->name('Xoa_Lop');
        Route::get('/edit/{id}', [LopController::class, 'edit'])->name('Edit_Lop');
        Route::post('/update', [LopController::class, 'update'])->name('Update_Lop');
        Route::match(['get', 'post'], '/add', [LopController::class, 'store'])->name('Add_Lop');
        Route::post('xoa-all', [LopController::class, 'destroyAll'])->name('Xoa_All_Lop');
        Route::post('/autocomplete-ajax', [LopController::class, 'autocomplete'])->name('Search_Lop');
    });

    // ca học


    //khuyến mại
    Route::prefix('/khuyen-mai')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [KhuyenMaiController::class, 'index'])->name('Khuyen_Mai');
        Route::get('/xoa/{id}', [KhuyenMaiController::class, 'destroy'])->name('Xoa_Khuyen_Mai');
        Route::get('/edit/{id}', [KhuyenMaiController::class, 'edit'])->name('Edit_Khuyen_Mai');
        Route::post('/update', [KhuyenMaiController::class, 'update'])->name('Update_Khuyen_Mai');
        Route::match(['get', 'post'], '/add', [KhuyenMaiController::class, 'store'])->name('Add_Khuyen_Mai');
        Route::post('xoa-all', [KhuyenMaiController::class, 'destroyAll'])->name('Xoa_All_Khuyen_Mai');
    });


    //khuyến mại
    Route::prefix('/phuong-thuc-thanh-toan')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [PhuongThucThanhToan::class, 'index'])->name('Phuong_Thuc_Thanh_Toan');
        Route::get('/xoa/{id}', [PhuongThucThanhToan::class, 'destroy'])->name('Xoa_Phuong_Thuc_Thanh_Toan');
        Route::get('/edit/{id}', [PhuongThucThanhToan::class, 'edit'])->name('Edit_Phuong_Thuc_Thanh_Toan');
        Route::post('/update', [PhuongThucThanhToan::class, 'update'])->name('Update_Phuong_Thuc_Thanh_Toan');
        Route::match(['get', 'post'], '/add', [PhuongThucThanhToan::class, 'store'])->name('Add_Phuong_Thuc_Thanh_Toan');
        Route::post('xoa-all', [PhuongThucThanhToan::class, 'destroyAll'])->name('Xoa_All_Phuong_Thuc_Thanh_Toan');
    });


    // admin quản lý tài khoản

    Route::prefix('/tai-khoan')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'index'])->name('Tai_Khoan');
        Route::get('/xoa/{id}', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'destroy'])->name('Xoa_Tai_Khoan');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'edit'])->name('Edit_Tai_Khoan');
        Route::post('/update', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'update'])->name('Update_Tai_Khoan');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Admin\TaiKhoanController::class, 'store'])->name('Add_Tai_Khoan');
        Route::post('xoa-all', [TaiKhoanController::class, 'destroyAll'])->name('Xoa_All_Tai_Khoan');
    });

    // banner

    Route::prefix('/banner')->name('route_BE_Admin_')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Admin\BannerController::class, 'index'])->name('Banner');
        Route::get('/xoa/{id}', [\App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('Xoa_Banner');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\BannerController::class, 'edit'])->name('Edit_Banner');
        Route::post('/update', [\App\Http\Controllers\Admin\BannerController::class, 'update'])->name('Update_Banner');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Admin\BannerController::class, 'store'])->name('Add_Banner');
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




// // route đào tạo
// Route::prefix('/admin')->middleware(['role:đào tạo'])->group(function () {
//     Route::get('/', function () {
//         return view('admin.trangchu');
//     });
//     Route::prefix('/xep-lop')->name('route_BE_Admin_')->group(function () {
//         Route::get('/', [XepLopController::class, 'index'])->name('Xep_Lop'); // hiển thị danh sách
//         Route::get('/xoa/{id}', [XepLopController::class, 'destroy'])->name('Xoa_Xep_Lop');
//         Route::get('/edit/{id}', [XepLopController::class, 'edit'])->name('Edit_Xep_Lop');
//         Route::get('/detail-lop/{id_xep_lop}', [LopController::class, 'show'])->name('Detail_Xep_Lop');
//         Route::post('/update', [XepLopController::class, 'update'])->name('Update_Xep_Lop');
//         Route::match(['get', 'post'], '/add', [XepLopController::class, 'store'])->name('Add_Xep_Lop');
//         Route::post('xoa-all', [XepLopController::class, 'destroyAll'])->name('Xoa_All_Xep_Lop');
//     });


//     Route::prefix('/ca-hoc')->name('route_BE_Admin_')->group(function () {
//         Route::get('/list', [CaHocController::class, 'index'])->name('Ca_Hoc');
//         Route::get('/xoa/{id}', [CaHocController::class, 'destroy'])->name('Xoa_Ca_Hoc');
//         Route::get('/edit/{id}', [CaHocController::class, 'edit'])->name('Edit_Ca_Hoc');
//         Route::post('/update', [CaHocController::class, 'update'])->name('Update_Ca_Hoc');
//         Route::match(['get', 'post'], '/add', [CaHocController::class, 'store'])->name('Add_Ca_Hoc');
//         Route::post('xoa-all', [CaHocController::class, 'destroyAll'])->name('Xoa_All_Ca_Hoc');
//     });

//     Route::prefix('danh-muc')->name('route_Admin_BE_')->group(function () {

//         Route::get('/', [DanhMucKhoaHoc::class, 'index'])->name('Danh_Muc_Khoa_Hoc'); // hiển thị danh sách
//         Route::match(['get', 'post'], '/danh-muc-add', [DanhMucKhoaHoc::class, 'store'])->name('Add_Danh_Muc'); // hiển thị danh sách
//         Route::get('/danh-muc-edit/{id}', [DanhMucKhoaHoc::class, 'edit'])->name('Edit_Danh_Muc'); // hiển thị danh sách
//         Route::post('/danh-muc-update', [DanhMucKhoaHoc::class, 'update'])->name('Update_Danh_Muc'); // hiển thị danh sách
//         Route::get('/danh-muc-xoa/{id}', [DanhMucKhoaHoc::class, 'destroy'])->name('Xoa_Danh_Muc'); // hiển thị danh sách
//         Route::post('/xoa-all', [DanhMucKhoaHoc::class, 'destroyAll'])->name('Xoa_All_Danh_Muc');
//     });


//     Route::prefix('/khoa-hoc')->name('route_BE_Admin_')->group(function () {

//         Route::get('/', [KhoahocController::class, 'index'])->name('Khoa_Hoc'); // hiển thị danh sách
//         Route::match(['get', 'post'], '/add-khoa-hoc',   [KhoahocController::class, 'store'])->name('Add_Khoa_Hoc'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
//         Route::get('/khoa-hoc-delete/{id}', [KhoahocController::class, 'destroy'])->name('Xoa_Khoa_Hoc');
//         Route::get('/khoa-hoc-chi-tiet/{id}', [KhoahocController::class, 'edit'])->name('Chi_Tiet_Khoa_Hoc'); // hiển thị chi tiết bản ghi
//         Route::post('/khoa-hoc-update', [KhoahocController::class, 'update'])->name('Update_Khoa_Hoc');
//         Route::post('/khoa-hoc-xoa-all', [KhoahocController::class, 'destroyAll'])->name('Xoa_All_Khoa_Hoc');
//     });

//     Route::prefix('lop-hop')->name('route_BE_Admin_')->group(function () {

//         Route::get('/list', [LopController::class, 'index'])->name('List_Lop');
//         Route::get('/xoa/{id}', [LopController::class, 'destroy'])->name('Xoa_Lop');
//         Route::get('/edit/{id}', [LopController::class, 'edit'])->name('Edit_Lop');
//         Route::post('/update', [LopController::class, 'update'])->name('Update_Lop');
//         Route::match(['get', 'post'], '/add', [LopController::class, 'store'])->name('Add_Lop');
//         Route::post('xoa-all', [LopController::class, 'destroyAll'])->name('Xoa_All_Lop');
//         Route::post('/autocomplete-ajax', [LopController::class, 'autocomplete'])->name('Search_Lop');
//     });


//     Route::get('/phong-hoc', [PhongHocController::class, 'index'])->name('route_BE_Admin_Phong_Hoc');
//     Route::match(['get', 'post'], '/phong-hoc-add', [PhongHocController::class, 'store'])->name('route_BE_Admin_Add_Phong_Hoc');
//     Route::get('/phong-hoc-edit/{id}', [PhongHocController::class, 'edit'])->name('route_BE_Admin_Edit_Phong_Hoc');
//     Route::post('/phong-hoc-update', [PhongHocController::class, 'update'])->name('route_BE_Admin_Update_Phong_Hoc');
//     Route::get('/phong-hoc-xoa/{id}', [PhongHocController::class, 'destroy'])->name('route_BE_Admin_Xoa_Phong_Hoc');
//     Route::post('xoa-all', [PhongHocController::class, 'destroyAll'])->name('route_BE_Admin_Xoa_All_Phong_Hoc');


//     Route::prefix('/dang-ky')->name('route_BE_Admin_')->group(function () {
//         Route::get('/', [DangKyController::class, 'index'])->name('List_Dang_Ky'); // hiển thị danh sách
//         Route::match(['get', 'post'], '/add-dang-ky',   [DangKyController::class, 'store'])->name('Add_Dang_Ky'); // hiển thi form để thêm dữ liệu và insert dữ liệu vào data
//         Route::get('/dang-ky-delete/{id}', [DangKyController::class, 'destroy'])->name('Xoa_Giang_Vien');
//         Route::get('/dang-ky-edit/{id}', [DangKyController::class, 'edit'])->name('Edit_Dang_Ky'); // hiển thị chi tiết bản ghi
//         Route::post('/dang-ky-update', [DangKyController::class, 'update'])->name('Update_Dang_Ky');
//         Route::post('xoa-all', [DangKyController::class, 'destroyAll'])->name('Xoa_All_Dang_Ky');
//     });
// });


// route kế toán
// Route::prefix('/admin')->middleware(['role:kế toán'])->group(function () {
//     Route::prefix('/phuong-thuc-thanh-toan')->name('route_BE_Admin_')->group(function () {
//         Route::get('/list', [PhuongThucThanhToan::class, 'index'])->name('Phuong_Thuc_Thanh_Toan');
//         Route::get('/xoa/{id}', [PhuongThucThanhToan::class, 'destroy'])->name('Xoa_Phuong_Thuc_Thanh_Toan');
//         Route::get('/edit/{id}', [PhuongThucThanhToan::class, 'edit'])->name('Edit_Phuong_Thuc_Thanh_Toan');
//         Route::post('/update', [PhuongThucThanhToan::class, 'update'])->name('Update_Phuong_Thuc_Thanh_Toan');
//         Route::match(['get', 'post'], '/add', [PhuongThucThanhToan::class, 'store'])->name('Add_Phuong_Thuc_Thanh_Toan');
//         Route::post('xoa-all', [PhuongThucThanhToan::class, 'destroyAll'])->name('Xoa_All_Phuong_Thuc_Thanh_Toan');
//     });
// });
