@extends('Admin.templates.layout')
@section('content')
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Lop') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Lớp <span class="text-danger">*</span></label>
                    <input id="tenLop1" value="{{ old('ten_lop') ?? request()->ten_lop }}" type="text" name="ten_lop"
                        class="form-control"  aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_lop')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lịch học <span class="text-danger">*</span></label>
                    <select class="form-control" name="ca_thu_id" id="">
                        <option value="0">--- Chọn lịch học ---</option>
                        @foreach ($cathu as $item)
                            <option value="{{ $item->id }}">

                                @foreach ($cahoc as $itemCa)
                                    {{-- {{$itemCa->ca_hoc}} --}}
                                    @if ($item->ca_id == $itemCa->id)
                                        {{ $itemCa->ca_hoc . ' ( ' . $itemCa->thoi_gian_bat_dau . ' - ' . $itemCa->thoi_gian_ket_thuc . ' ) ' . ' : ' }}
                                    @else
                                        {{ '' }}
                                    @endif
                                @endforeach

                                <?php
                                
                                for ($i = 0; $i < count([$item->thu_hoc_id]); $i++) {
                                    $str = explode(',', $item->thu_hoc_id);
                                }
                                
                                for ($i = 0; $i < count($str); $i++) {
                                    foreach ($thu as $key => $value) {
                                        $count = count($str) - 1;
                                        if ($i == $count) {
                                            if ($str[$i] == $value->id) {
                                                echo $value->ten_thu . ' ';
                                            }
                                        } else {
                                            if ($str[$i] == $value->id) {
                                                echo $value->ten_thu . ' & ';
                                            }
                                        }
                                    }
                                }
                                
                                ?>
                            </option>
                        @endforeach
                    </select>
                    @error('ca_thu_id')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Khóa học <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_khoa_hoc" id="khoaHoc" data-url='{{route('admin_lay_tien_to')}}'>
                        <option value="0">--- Chọn khóa học ---</option>
                        @foreach ($khoahoc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                        @endforeach
                    </select>
                    @error('id_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

            <div class="col-6">


                {{-- <div class="mb-3">
                    <label for="" class="form-label">Số ghế <span class="text-danger">*</span></label>
                    <input value="{{ old('so_luong') ?? request()->so_luong }}" class="form-control" type="number" name="so_luong" id="">
                    @error('so_luong')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input value="{{ old('ngay_bat_dau') ?? request()->ngay_bat_dau }}" class="form-control" type="date"
                        name="ngay_bat_dau" id="">
                    @error('ngay_bat_dau')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Thời gian khóa học ( tháng ) <span
                            class="text-danger">*</span></label>
                    <input value="{{ old('thoi_gian') ?? request()->thoi_gian }}" class="form-control" type="text"
                        name="thoi_gian" id="">
                    @error('thoi_gian')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Giảng Viên <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_giang_vien" id="">
                        <option value="0">--- Chọn giảng viên ---</option>
                        @foreach ($giangvien as $item)
                            <option value="{{ $item->id_user }}">{{ $item->ten_giang_vien }}</option>
                        @endforeach
                    </select>
                    @error('id_giang_vien')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a class="btn btn-danger" href=" {{ route('route_BE_Admin_List_Lop') }} ">Hủy</a>

    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $(document).on('change', '#khoaHoc', function (event) {
                const url = $(this).data('url')
                const data = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id_khoa_hoc: data
                    },
                    success: function (res) {
                        let today = new Date();
                        let dd = today.getDate();
                        let mm = today.getMonth() + 1;
                        let yyyy = today.getFullYear();
                       $('#tenLop1').val(res + dd + mm + yyyy);
                    }
                })
            })
        })
    </script>
@endsection


