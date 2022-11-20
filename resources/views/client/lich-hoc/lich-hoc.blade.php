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

    {{-- <h2>Lịch học</h2>
    <div class="calendar">
        <div class="row align-content-center bg-dedede" style="height: 50px;">
            <span class="font-weight-bold">Lịch học</span>
        </div>

        <div class="row align-content-center bg-cfcece font-weight-bold" style="height: 50px;">
            <div class="col">
                <label>STT</label>
            </div>
            <div class="col">
                <label>Ngày</label>
            </div>
            <div class="col">
                <label>Phòng</label>
            </div>
            <div class="col">
                <label>Tên khóa học</label>
            </div>
            <div class="col">
                <label>Lớp</label>
            </div>
            <div class="col">
                <label>Giảng viên</label>
            </div>
            <div class="col">
                <label>Ca</label>
            </div>
            <div class="col">
                <label>Thời gian</label>
            </div>
            <div class="col">
                <label>Mô tả</label>
            </div>
        </div>

        @foreach ($lichhoc as $value )
            <div class="row align-content-center bg-dedede" style="height: 50px; border-top: 1px solid #CFCECE">
                <div class="col">
                    <span> {{ $loop->iteration }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ngay_dang_ky }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ten_phong }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ten_khoa_hoc }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ten_lop }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ten_giang_vien }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->ca_hoc }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->thoi_gian }} </span>
                </div>
                <div class="col">
                    <span> {{ $value->mo_ta }} </span>
                </div>
            </div>
        @endforeach --}}

    </div>
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
                                    {{ $item->thoi_gian_bat_dau  }} -
                                    {{ $item->thoi_gian_ket_thuc  }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
