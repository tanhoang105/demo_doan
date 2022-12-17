@extends('client.templates.layout')
@section('content')
    <style>
        .styled-table {
            width:1000px;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 20px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
    <br>
{{--    {{dd($list)}}--}}
    <center>
        <table class="styled-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Tên Lớp</th>
                <th>Khóa Học</th>
                <th>Giá</th>
                <th>Địa chỉ</th>
                <th>Sđt</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th>Hủy đăng ký</th>
            </tr>
            </thead>
            {{-- {{dd($list)}} --}}
            @foreach ($list as $item)
                <tbody>
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->ten_lop}}</td>
                    <td>{{$item->ten_khoa_hoc}}</td>
                    <td>{{$item->gia_khoa_hoc}} VNĐ</td>
                    <td>{{$item->dia_chi}}</td>
                    <td>{{$item->sdt}}</td>
                    <td>
                       @if($item->trang_thai_thanh_toan == 1)
                           @if ($item->trang_thai==1)
                           <form action="{{route('payment',[$item->id])}}" method="post">
                            @csrf
                            <input type="text" name="gia_khoa_hoc_payment" value="{{$item->gia_khoa_hoc}}" hidden>
                            <input type="text" name="id" value="{{$item->id}}" hidden>
                            <div class="form-group">
                                <button type="submit" id="btn-payment" name="redirect" class="btn btn-dark btm-md">Thanh Toán VNPAY</button>
                            </div>
                        </form>
                           @else
                          
                           @endif
                        @else
                            <center><span class="btn btn-success" >Đã Thanh Toán</span></center>
                        @endif
                    </td>
                    <td>
                    
                        @if ($item->trang_thai==1)
                            <center><button class="btn btn-primary" style="width: 100px;height: 95px">Đã duyệt</button></center>
                        @else
                            <center><button class="btn btn-danger" style="width: 100px;height: 95px">Đã hủy</button></center>
                        @endif
                    </td>
                    <td>

                        @if ($item->trang_thai==1)
                        @if ($item->trang_thai_thanh_toan==2)
                        <center><button class="btn btn-warning" style="width: 100px;height: 95px">Không thể hủy</button></center>
                        @else
                        <form method="post" action="{{route('huy_dang_ky',[$item->id])}}">
                            @csrf
                            <input type="text" name="trang_thai" value="3" hidden>
                            <button onclick="confirm('Bạn đã hủy thành công!')" class="btn btn-success" type="submit" style="width: 100px;height: 95px">Hủy</button>
                        </form>
                        @endif
                        @else
                        <center><button class="btn btn-success" style="width: 100px;height: 95px">Hủy</button></center>
                        @endif

                    </td>
                </tr>
                </tbody>
            @endforeach

        </table>
    </center>

@endsection
