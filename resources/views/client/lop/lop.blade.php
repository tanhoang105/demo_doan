@extends('client.profile.layout')
@section('title')
    Lớp
@endsection
@section('content')
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    <h2>Danh sách các lớp đã đăng ký</h2>
    <div class="List">
        <div class="row justify-content-center">
            @foreach ($list as $value)
            <div class="col-lg-3 box-shadow br-15" style="margin-left: 70px;height: 320px;margin-top: 40px;">
                <div class="row p-1">
                    <h3 class="col-lg-8 pt-1">{{ $value->ten_lop }}</h3>

                    <div class="col-lg-4 p-2">
                        @if ($value->ngay_bat_dau < date(now()))
                        <div class="br-15" style="background: #30e534">
                            <span class="d-flex justify-content-center text-white">Đã học</span>
                        </div>
                        @else
                        <div class="br-15" style="background: #ff0018">
                            <span class="d-flex justify-content-center text-white">Chưa học</span>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="w-100" style="height: 15px"></div>

                <div class="">
                    <label class="">Số lượng: </label>
                    <span class="">{{ 40 - ($value->so_luong) }}/40</span>
                </div>

                <div class="">
                    <label class="">Giảng viên: </label>
                    <span class="">{{ $value->ten_giang_vien }}</span>
                </div>

                <div class="">
                    <label class="">Ngày bắt đầu: </label>
                    <span class="">{{ date('d-m-Y', strtotime($value->ngay_bat_dau)) }}</span>
                </div>

                <div class="">
                    <label class="">Ca học: </label>
                    <span class=""><?php
                        foreach ($array as $item) {
                            if ($item->id == $value->id_lop) {
                                // tìm ca thu
                                // echo  $item->ca_thu_id;
                                foreach ($cathu as $itemCaThu) {
                                    if ($item->ca_thu_id == $itemCaThu->id) {
                                        // echo $itemCaThu->ca_id;
                                        // lấy ra ca hoc
                                        foreach ($cahoc as $key => $itemCaHoc) {
                                            if ($itemCaThu->ca_id == $itemCaHoc->id) {
                                                echo  "<li>" . $itemCaHoc->ca_hoc . ' ( ' . $itemCaHoc->thoi_gian_bat_dau . ' - ' . $itemCaHoc->thoi_gian_ket_thuc  . ')' . '</li>';
                                            }
                                        }
                                        // lấy ra ngày học
                                        // echo $itemCaThu->thu_hoc_id;
                                        $arrayThu = explode(',', $itemCaThu->thu_hoc_id);
                                        for ($i = 0; $i < count($arrayThu); $i++) {
                                            foreach ($thu as $key => $itemThu) {
                                                if ($i == 0) {
                                                    if ($arrayThu[$i] == $itemThu->id) {
                                                        echo '( ' . $itemThu->ten_thu . ' & ';
                                                    }
                                                } elseif($i == (count($arrayThu) - 1) ) {
                                                    if ($arrayThu[$i] == $itemThu->id) {
                                                        echo '' . $itemThu->ten_thu . ')';
                                                    }
                                                }else {
                                                    if ($arrayThu[$i] == $itemThu->id) {
                                                        echo '' . $itemThu->ten_thu . ' & ';
                                                    }
                                                }
                                            }
                                        }
                        
                                        // ===
                                    }
                                }
                            }
                        }
                        
                        ?></span>
                </div>

                <hr>

                <div class="Change">
                    {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                    <form action="{{ route('form_doi_lop', $value->lop_id) }}" method="GET">
                        @csrf
                        {{-- <input type="date" name="ngaybatdau_lopcu" value="{{$value->ngay_bat_dau}}" id=""> --}}
                        <input type="text" value="{{ $value->khoa_hoc_id }}" name="khoahoc_id" hidden
                               id="">
                        <input type="text" name="xeplop_id" value="{{ $value->id }}" hidden
                               id="">
                        @if ($value->ngay_bat_dau >= date(now()))
                    <button class="btn btn-primary">
                        Đổi lớp
                    </button>
                        @endif
                    </form>
                </div>

            </div>
            @endforeach

        </div>
    </div>

@endsection
