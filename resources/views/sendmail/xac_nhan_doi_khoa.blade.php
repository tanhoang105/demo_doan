<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2 style="color: red">ĐÃ XÁC NHẬN YÊU CẦU ĐỔI KHÓA HỌC</h2>
    <p> {{ $emails['message'] }}</p>
    @if ($emails['khoan_no'] < 0)
        <p><span>Hệ thống sẽ hoàn lại <span style="font-weight: bold">{{ number_format($emails['khoan_no'] * (-1)) }}
                    VND</span>
                vào tài khoản số dư của bạn </p>
    @elseif ($emails['khoan_no'] > 0)
        <p><span>Bạn cần thanh toán <span style="font-weight: bold">{{ number_format($emails['khoan_no']) }} VND</span>
                để được xếp lịch và tham gia lớp học </p>
    @endif
    <p><span>Khóa học cũ :</span> <span>{{ $emails['khoa_hoc_cu'] }}</span></p>
    <p><span>Khóa học mới :</span> <span>{{ $emails['khoa_hoc_moi'] }}</span></p>
    <p><span>Ngày xác nhận:</span> <span>{{ $emails['ngay_xac_nhan'] }}</span></p>

</body>

</html>
