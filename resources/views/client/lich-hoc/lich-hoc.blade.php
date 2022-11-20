@extends('Client.profile.layout')
@section('title')
    - Lịch học
@endsection
@section('content')
    <h2>Lịch học</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thứ</th>
                    <th>Ngày</th>
                    <th>Phòng</th>
                    <th>Tên khóa học</th>
                    <th>Lớp</th>
                    <th>Giảng viên</th>
                    <th>Ca</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @foreach ($thuhoc as $item)
                                @if ($item->id == $value->ma_thu)
                                    {{ $item->ten_thu }}
                                @endif
                            @endforeach


                        </td>
                        <td>{{ $value->ngay_hoc }}</td>
                        <td>
                            @foreach ($phonghoc as $item)
                                @if ($item->id == $value->id_phong_hoc)
                                    {{ $item->ten_phong }}
                                @endif
                            @endforeach


                        </td>
                        <td>
                            @foreach ($khoa_hoc as $item)
                                @if ($item->id == $value->id_khoa_hoc)
                                    {{ $item->ten_khoa_hoc }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($lop as $item)
                                @if ($item->id == $value->id_lop)
                                    {{ $item->ten_lop }}
                                @endif
                            @endforeach

                        </td>
                        <td>
                            @foreach ($giang_vien as $item)
                                @if ($item->id_user == $value->id_giang_vien)
                                    {{ $item->ten_giang_vien }}
                                @endif
                            @endforeach

                        </td>
                        <td>


                            @foreach ($ca_hoc as $item)
                                @if ($item->id == $value->ca_id)
                                    {{ $item->ca_hoc }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($ca_hoc as $item)
                                @if ($item->id == $value->ca_id)
                                    {{ $item->thoi_gian }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
