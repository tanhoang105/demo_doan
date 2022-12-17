@extends('client.profile.layout')
@section('title')
    Đăng kí đổi lớp
@endsection
@section('content')
    <div class="container">
        <h2>Đăng ký đổi lớp</h2>

        <form action="{{ route('doi_lop') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lớp học cũ</label>
                    <input type="text" class="form-control" value="{{ $lop_cu->ten_lop }}" disabled>
                    <input type="text" name="id_lop_cu" value="{{ $lop_cu->id }}" hidden>
                    {{-- <input type="text" name="id_xeplop" value="{{$xep_lop->id}}" hidden> --}}
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lớp học mới</label>
                    <select class="form-control" data-url="{{ route('siso_doilop') }}" id="id_lop_moi" name="id_lop_moi">
                        <option value="">----- Chọn lớp mới muốn đổi ------</option>
                        @foreach ($lop_moi as $value)
                            <option value="{{ $value->id }}">{{ $value->ten_lop . ' -- ' }}
                                <?php 
                                foreach ($array as $item) {
                                    if ($item->id == $value->id) {
                                        // tìm ca thu
                                        // echo  $item->ca_thu_id;
                                        foreach ($cathu as $itemCaThu) {
                                            if ($item->ca_thu_id == $itemCaThu->id) {
                                                // echo $itemCaThu->ca_id;
                                                // lấy ra ca hoc
                                                foreach ($cahoc as $key => $itemCaHoc) {
                                                    if ($itemCaThu->ca_id == $itemCaHoc->id) {
                                                        echo '<li>' . $itemCaHoc->ca_hoc . ' ( ' . $itemCaHoc->thoi_gian_bat_dau . ' - ' . $itemCaHoc->thoi_gian_ket_thuc . ')' . '</li>';
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
                                
                                                // ===
                                            }
                                        }
                                    }
                                }
                                
                                ?>


                            </option>
                        @endforeach
                    </select>
                    @error('id_lop_moi')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                    @if (session()->has('loi_trung'))
                    <span style="color: red">
                        {{ session()->get('loi_trung') }}
                    </span>
                    @endif
                </div>
                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Ghế trống</label>
                    <input disabled class="form-control" name="so_luong" id="so_luong" type="text">
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Giảng viên</label>
                    <input disabled class="form-control" name="" id="giang_vien" name="giang_vien" type="text">
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lý do</label>
                    <textarea class="form-control" style="height: 150px;" name="ly_do" placeholder="Lý do bạn muốn đổi lớp"></textarea>
                </div>

                <div class="pt-2">
                    <input type="text" name="status" id="" value="0" hidden>
                    <input type="text" name="id_user" id="" value="{{ Auth::user()->id }}" hidden>
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn đổi lóp ')" class="btn btn-primary">Gửi
                        yêu cầu </button>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#id_lop_moi', function(event) {
                console.log(1, 22)
                const url = $(this).data('url')
                const data = $(this).val();
                console.log(url, data);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id_lop_moi: data
                    },
                    success: function(res) {
                        console.log(res, 1122)
                        let so_luong = res.ghe_trong;
                        let giang_vien = res.giangvien;
                        console.log(so_luong);
                        console.log(giang_vien);
                        $('#so_luong').val(so_luong)
                        $('#giang_vien').val(giang_vien)

                    }
                })

            })
        })
    </script>
@endsection
