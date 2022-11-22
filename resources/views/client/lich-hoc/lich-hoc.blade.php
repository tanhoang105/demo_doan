@extends('Client.profile.layout')
@section('title')
    Lịch học
@endsection
@section('content')

     <h2>Lịch học</h2>
    <div class="calendar">
        <div class="row align-content-center bg-dedede" style="height: 50px;">
            <span class="font-weight-bold">Lịch học</span>
        </div>

        <div class="row align-content-center bg-cfcece font-weight-bold" style="height: 50px;">
            <div class="col">
                <label>STT</label>
            </div>
            <div class="col">
                <label>Thứ</label>
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

        </div>

        @foreach ($list as $value )
            <div class="row align-content-center bg-dedede" style="height: 50px; border-top: 1px solid #CFCECE">
                <div class="col">
                    <span> {{ $loop->iteration }} </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($thuhoc as $item)
                            @if ($item->id == $value->ma_thu)
                                {{ $item->ten_thu }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span> {{ $value->ngay_hoc }} </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($phonghoc as $item)
                            @if ($item->id == $value->id_phong_hoc)
                                {{ $item->ten_phong }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($khoa_hoc as $item)
                            @if ($item->id == $value->id_khoa_hoc)
                                {{ $item->ten_khoa_hoc }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($lop as $item)
                            @if ($item->id == $value->id_lop)
                                {{ $item->ten_lop }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($giang_vien as $item)
                            @if ($item->id_user == $value->id_giang_vien)
                                {{ $item->ten_giang_vien }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($ca_hoc as $item)
                            @if ($item->id == $value->ca_id)
                                {{ $item->ca_hoc }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col">
                    <span>
                        @foreach ($ca_hoc as $item)
                            @if ($item->id == $value->ca_id)
                                {{ $item->thoi_gian_bat_dau  }} -
                                {{ $item->thoi_gian_ket_thuc  }}
                            @endif
                        @endforeach
                    </span>
                </div>
            </div>
        @endforeach

    </div>

@endsection
