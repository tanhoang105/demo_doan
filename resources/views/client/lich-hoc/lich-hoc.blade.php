@extends('Client.profile.layout')
@section('title')
    Lịch học
@endsection
@section('content')

    <div class="calendar">
        <div class="row align-content-center bg-dedede" style="height: 50px;">
            <span class="font-weight-bold text-dark">Lịch học</span>
        </div>

        <div class="row align-content-center bg-cfcece font-weight-bold" style="height: 50px;">
            <div class="col text-dark">
                <label>STT</label>
            </div>
            <div class="col text-dark">
                <label>Thứ</label>
            </div>
            <div class="col text-dark">
                <label>Ngày</label>
            </div>
            <div class="col text-dark">
                <label>Phòng</label>
            </div>
            <div class="col text-dark">
                <label>Tên khóa học</label>
            </div>
            <div class="col text-dark">
                <label>Lớp</label>
            </div>
            <div class="col text-dark">
                <label>Giảng viên</label>
            </div>
            <div class="col text-dark">
                <label>Ca</label>
            </div>
            <div class="col text-dark">
                <label>Thời gian</label>
            </div>

        </div>
        {{-- @if() --}}
        @foreach ($list as $value )
            @if($value->ngay_hoc >= date('Y-m-d'))
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
            @endif
        @endforeach

        
    </div>

    <div class="row pt-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('extParams')->links() }}
        </div>
    </div>
    

@endsection
