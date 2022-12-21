<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2 style="color: red">XÁC NHẬN ĐỔI LỚP THÀNH CÔNG</h2>
    <p> {{ $emails['message'] }}</p>
    <p><span>Lớp cũ :</span> <span>{{ $emails['lop_cu'] }}</span></p>
    <p><span>Lớp mới :</span> <span>{{ $emails['lop_moi'] }}</span></p>
    <p><span>Ngày xác nhận:</span> <span>{{ $emails['ngay_xac_nhan'] }}</span></p>
</body>

</html>
