<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gửi Email bằng STMP Gmail</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div>
     
     <h1>{{$emails['message']}}</h1>
    <h3>Xin chào: {{$emails['user']['name']}}</h3>
    <h5>Bạn đã mua hàng thành công!</h5>
    <h5>Email: {{$emails['user']['email']}}</h5>
    <h5>Địa chỉ: {{$emails['user']['dia_chi']}}</h5>
    <h5>Số điện thoại: {{$emails['user']['sdt']}}</h5>
    <h4>Tài khoản: {{$emails['user']['email']}} </h4>
    @if (isset($emails['password']))
    <h4>Mật khẩu: {{$emails['password']}}</h4>
    @else
    @endif


    <table class="table table-bordered" border="1">
        <thead>
        <tr>
            <th scope="col">Tên Khóa học</th>
            <th scope="col">Tên lớp</th>
            <th scope="col">Tên giảng viên</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thứ học </th>
            <th scope="col">Ca học - Thời gian học</th>
            <th scope="col">Tổng tiền</th>
        </tr>
        </thead>
        <tbody>
           <tr>
               <th>{{$emails['dangky']->ten_khoa_hoc}}</th>
               <th>{{$emails['dangky']->ten_lop}}</th>
               <th>{{$emails['dangky']->ten_giang_vien}}</th>
               <th>{{$emails['dangky']->so_luong}}</th>
               <th>
               @foreach($emails['thuhoc'] as $thu)
               {{$thu->ten_thu}}
               @endforeach
               </th>
               <th>{{$emails['dangky']->ca_hoc}} - {{$emails['dangky']->thoi_gian_bat_dau . ' - ' . $emails['dangky']->thoi_gian_ket_thuc}}</th>
               <td>{{number_format($emails['dangky']->gia_khoa_hoc)}} VNĐ</td>
           </tr>
        <tr>
            <th>
                <a href="{{route('home')}}">Đăng nhập để xem chi tiết đơn hàng</a>
            </th>
        </tr>
        </tbody>

    </table>

</div>
