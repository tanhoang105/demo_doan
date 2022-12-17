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
        <div class="row">
            @foreach ($list as $value)
                <div class="col-lg-3 box-shadow br-15" style="margin-left: 70px;margin-top:20px;width: 280px;">
                    <div class="row p-1">
                        <span class=" pt-2 text-dark" style="font-size: 25px;font-weight: 700;">{{ $value->ten_lop }}</span>
                    </div>

                    <div class="w-100" style="height: 10px"></div>

                    <div class="text-dark row">
                        <div class="col-7">
                            <label class="">Số lượng: </label>
                            <span class="">{{ 40 - $value->so_luong }}/40</span>
                        </div>

                        <div class="col-5 p-0">
                            @if ($value->ngay_bat_dau < date(now()))
                                <div class="br-15" style="background: #30e534;width: 100px;">
                                    <span class="d-flex justify-content-center text-white">Đang học</span>
                                </div>
                            @else
                                <div class="br-15" style="background: #ff0018;width: 100px;">
                                    <span class="d-flex justify-content-center text-white">Chưa học</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-dark">
                        <label class="">Giảng viên: </label>
                        <span class="">{{ $value->ten_giang_vien }}</span>
                    </div>

                    <div class="text-dark">
                        <label class="">Ngày bắt đầu: </label>
                        <span class="">{{ date('d-m-Y', strtotime($value->ngay_bat_dau)) }}</span>
                    </div>

                    <div class="text-dark row">
                        <label class="col-4">Ca học: </label>
                        <span class="col-8 p-0">
                            <?php
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
                                                    echo '<li style="list-style: none;">' . $itemCaHoc->ca_hoc . ' ( ' . $itemCaHoc->thoi_gian_bat_dau . ' - ' . $itemCaHoc->thoi_gian_ket_thuc . ')' . '</li>';
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
                                                    } elseif ($i == count($arrayThu) - 1) {
                                                        if ($arrayThu[$i] == $itemThu->id) {
                                                            echo '' . $itemThu->ten_thu . ')';
                                                        }
                                                    } else {
                                                        if ($arrayThu[$i] == $itemThu->id) {
                                                            echo '' . $itemThu->ten_thu . ' & ';
                                                        }
                                                    }
                                                }
                                            }
                            
                                          
                                        }
                                    }
                                }
                            }
                            
                            ?>
                        </span>
                    </div>

                    <hr>

                    <div class="Change">
                        {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                        <form action="{{ route('form_doi_lop', $value->lop_id) }}" method="GET">
                            @csrf
                            {{-- <input type="date" name="ngaybatdau_lopcu" value="{{$value->ngay_bat_dau}}" id=""> --}}
                            <input type="text" value="{{ $value->khoa_hoc_id }}" name="khoahoc_id" hidden id="">
                            <input type="text" name="xeplop_id" value="{{ $value->id }}" hidden id="">
                            @if ($value->ngay_bat_dau >= date(now()))
                                <button class="btn btn-primary" style="width: 150px;height: 45px;border-radius: 15px;">
                                    Đổi lớp
                                </button>
                            @else
                                <button class="btn btn-primary" style="width: 150px;height: 45px;border-radius: 15px;"
                                    disabled>
                                    Đổi lớp
                                </button>
                            @endif
                        </form>



                    </div>

                    <div class="w-100" style="height: 20px">

                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
