<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DangKy;
use App\Models\Payment;
use App\Models\ThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ThanhToanController extends Controller
{
    //
    public function __construct()
    {
        $this->vnp=Config::get('vnp');
//        dd($this->vnp['vnp_Returnurl']);
        $this->obj=new ThanhToan();
    }
    public function vnpPayment(Request $request)
    {
//        dd($this->vnp['vnp_TmnCode']);
//        $vnp_Inv_Type= time();
        $vnp_TxnRef = $request->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh Toán Qua VN Pay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->gia_khoa_hoc_payment *100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//        dd($vnp_TxnRef);
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp['vnp_TmnCode'],
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnp['vnp_Returnurl'],
//            "vnp_Inv_Type"=>$vnp_Inv_Type,
            "vnp_TxnRef" =>$vnp_TxnRef,
        );
//        dd($vnp_Inv_Type,$vnp_TxnRef);
//        dd(str_replace($vnp_Inv_Type,'',$vnp_TxnRef));
//        dd($inputData);
//        echo "<pre>";
//        print_r($inputData);
//        echo "</pre>";
//        die();
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

//var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp['vnp_Url'] . "?" . $query;
        if (isset($this->vnp['vnp_HashSecret'])) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->vnp['vnp_HashSecret']);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function IPN(Request $request)
    {
        //  dd(1);
        /* Payment Notify
   * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
   * Các bước thực hiện:
   * Kiểm tra checksum
   * Tìm giao dịch trong database
   * Kiểm tra số tiền giữa hai hệ thống
   * Kiểm tra tình trạng của giao dịch trước khi cập nhật
   * Cập nhật kết quả vào Database
   * Trả kết quả ghi nhận lại cho VNPAY
   */
        $vnp_HashSecret=$this->vnp['vnp_HashSecret'];
        $inputData = array();
        $returnData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
//        $bank=$inputData['vnp_BankTranNo'];
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
        $trnag_thai = 1; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo
//        URL thanh toán.
//        dd($paid);
        $id = $inputData['vnp_TxnRef'];
//        echo "<pre>";
//        print_r($id);
//        echo "</pre>";
//        die();
        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);
                $result=$this->obj->loadOne($id);
//                dd($result);
                $order = [];
                foreach ($result as $or) {
                    $order[] = $or;
                }
                if ($order != NULL) {
                    if ($order[0]->gia == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền
//                    kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        if ($order[0]->trang_thai == 1) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $trang_thai = 2; // Trạng thái thanh toán thành công
                            } else {
                                $trnag_thai = 1; // Trạng thái thanh toán thất bại / lỗi
                            }
                            //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                            $query=$this->obj->updatePaid($id);
                            return view('client.thanh-toan.thanh-toan-thanh-cong');
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }

    public function resultPay(Request $request){
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $this->vnp['vnp_HashSecret']);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $vnp_HashSecret=$this->vnp['vnp_HashSecret'];
                $inputData = array();
                $returnData = array();
                foreach ($_GET as $key => $value) {
                    if (substr($key, 0, 4) == "vnp_") {
                        $inputData[$key] = $value;
                    }
                }
                $vnp_SecureHash = $inputData['vnp_SecureHash'];
                unset($inputData['vnp_SecureHash']);
                ksort($inputData);
                $i = 0;
                $hashData = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                }
        //        $bank=$inputData['vnp_BankTranNo'];
                $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
                $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
                $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
                $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
                $trang_thai = 1; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo
        //        URL thanh toán.
        //        dd($paid);
                $id = $inputData['vnp_TxnRef'];
                // $id = $inputData['vnp_TxnRef'];
        //        echo "<pre>";
        //        print_r($id);
        //        echo "</pre>";
        //        die();
                try {
                    //Check Orderid
                    //Kiểm tra checksum của dữ liệu
                    if ($secureHash == $vnp_SecureHash) {
                        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                        //Giả sử: $order = mysqli_fetch_assoc($result);
                        $result=$this->obj->loadOne($id);
                        $objDangKy = new DangKy();
                        $dangKy=$objDangKy->loadOne($id);
                        $order = [];
                        foreach ($result as $or) {
                            $order[] = $or;
                        }
                        if ($order != NULL) {
                            if ($order[0]->gia == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền
        //                    kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                            {
                                if ($order[0]->trang_thai == 1) {
                                    if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                        $trang_thai = 3; // Trạng thái thanh toán thành công
                                    } else {
                                        $trang_thai = 1; // Trạng thái thanh toán thất bại / lỗi
                                    }
                                    //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                                    $returnData['RspCode'] = '00';
                                    $returnData['ngay_thanh_toan'] = date('Y-m-d');
                                    $returnData['Message'] = 'Confirm Success';
                                    //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                                    $query=$this->obj->updatePaid($id);
                                    $tinhSoLuong = $dangKy->so_luong - 1;
                                    $soLuongLop = DB::table('lop')
                                        ->where('id', $dangKy->id_lop)
                                        ->update(['so_luong' => $tinhSoLuong]);
                                    return view('client.thanh-toan.thanh-toan-thanh-cong');
                                } else {
                                    $returnData['RspCode'] = '02';
                                    $returnData['Message'] = 'Order already confirmed';
                                }
                            } else {
                                $returnData['RspCode'] = '04';
                                $returnData['Message'] = 'invalid amount';
                            }
                        } else {
                            $returnData['RspCode'] = '01';
                            $returnData['Message'] = 'Order not found';
                        }
                    } else {
                        $returnData['RspCode'] = '97';
                        $returnData['Message'] = 'Invalid signature';
                    }
                } catch (Exception $e) {
                    $returnData['RspCode'] = '99';
                    $returnData['Message'] = 'Unknow error';
                }
                //Trả lại VNPAY theo định dạng JSON
                echo json_encode($returnData);
//                echo "GD Thanh cong";
                return view('client.thanh-toan.thanh-toan-thanh-cong');
            }
            else {
                // dd($request->vnp_TxnRef);
                $dataDangKyOld = DB::table('dang_ky')->where('id',$request->vnp_TxnRef)->first();
                if($dataDangKyOld != null){
                    $data = [
                        'ngay_dang_ky' => $dataDangKyOld->ngay_dang_ky,
                        'id_thanh_toan' => $dataDangKyOld->id_thanh_toan,
                        'gia' => $dataDangKyOld->gia,
                        'email'=>$dataDangKyOld->email,
                        'id_lop' => $dataDangKyOld->id_lop,
                        'id_user' => $dataDangKyOld->id_user,
                        'trang_thai' => $dataDangKyOld->trang_thai,
                        'delete_at' => $dataDangKyOld->delete_at,
                        'created_at' => $dataDangKyOld->created_at,
                        'updated_at' => $dataDangKyOld->updated_at,
                    ];
                    DB::table('dang_ky')->where('id',$request->vnp_TxnRef)->delete();
                    DB::table('dang_ky')->insert($data);
                }

                echo "GD Khong thanh cong";
            }
        } else {
            echo "Chu ky khong hop le";
        }

    }


}
