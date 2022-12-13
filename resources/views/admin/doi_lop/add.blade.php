@extends('Admin.templates.layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <form class="p-5" action="{{ route('route_BE_Admin_store_doi_khoa') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                {{-- <input class="signup-field" name="gia_khoa_hoc" id="gia_khoa_hoc" type="text" value="" hidden> --}}
                <div class="mb-3">
                    <label for="" class="form-label">Mã sinh viên</label>
                    <input class="form-control" value="" name="id_user" id="ma_hoc_vien" type="text"
                        placeholder="Mã sinh viên">
                        @error('id_user')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên học viên</label>
                    <input class="form-control" name="ten_hoc_vien" id="ten_hoc_vien" type="text" value=""
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Khóa học cần đổi</label>
                    <select class="form-control" name="id_lop_cu" id="id_khoa_hoc_cu" data-url="">
                        <option value="">chọn khóa học</option>}}
                        {{-- @foreach ($listKhoaHoc as $item)
                                <option  value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                            @endforeach --}}
                    </select>
                    @error('id_lop_cu')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
                </div>
                <script>
                    $('#ma_hoc_vien').keyup(function(e) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "/admin/doi-lop/hienthidoilop/" + $('#ma_hoc_vien').val(),
                            // data: "data",
                            dataType: "json",

                            success: function(response) {
                                console.log(response);
                                let htmls = "<option>chọn khóa học</option>"
                                // 
                                response.forEach(function(item) {
                                    console.log(item)
                                    htmls +=
                                        ` <option  value="${ item.id_lop }">${ item.ten_khoa_hoc }</option>`
                                    $('#ten_hoc_vien').val(item.name)
                                })
                                $('#id_khoa_hoc_cu').html(htmls)

                            }
                        });
                    });
                </script>
                <div class="mb-3">
                    <label for="" class="form-label">khóa học mới</label>
                    <select class="form-control" name="" id="id_khoa_hoc" data-url="{{ route('admin_dang_ky') }}">
                        <option value="">chọn khóa học</option>
                        @foreach ($list_khoa_hoc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_khoa_hoc }}</option>
                        @endforeach
                    </select>
                    @error('id_khoa_hoc')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp </label>
                    <select class="form-control" name="id_lop_moi" data-url="{{ route('siso_doilop') }}" id="id_lop">
                        <option>--Chọn Lớp--</option>
                    </select>
                    @error('id_lop_moi')
                    <span style="color: red"> {{ $message }} </span>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Học phí</label>
                    <input class="form-control" name="" id="id_gia" type="text" value="" disabled>
                </div>
                <script>
                    $(document).ready(function() {
                        $(document).on('change', '#id_khoa_hoc', function(event) {
                            console.log(1)
                            const url = $(this).data('url')
                            const data = $(this).val();
                            console.log(url, data);
                            $.ajax({
                                type: 'GET',
                                url: url,
                                data: {
                                    id_khoa_hoc: data
                                },
                                success: function(res) {
                                    console.log(res)
                                    let htmls = "<option>--Chọn Lớp--</option>"
                                    let ten_lop = Object.values(res.lop);
                                    console.log(res.lop);
                                    ten_lop.forEach(function(item) {
                                        console.log(item)
                                        htmls +=
                                            ` <option  value="${ item.id }">${ item.ten_lop }</option>`
                                    })
                                    $('#id_gia').val(res.gia_khoa_hoc)
                                    // $('#so_luong').val(res.so_luong)
                                    $('#gia_khoa_hoc').val(res.gia_khoa_hoc)
                                    $('#id_lop').html(htmls)
                                }
                            })
                        })
                    })
                </script>
                <div class="mb-3">
                    <label for="" class="form-label">Số lượng ghế trống</label>
                    <input disabled class="form-control" name="so_luong" id="so_luong" type="text">
                </div>
                {{-- test  --}}
                <script>
                    $(document).ready(function() {
                        $(document).on('change', '#id_lop', function(event) {
                            console.log(1)
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
                                    console.log(res)
                                    let so_luong = res.ghe_trong;
                                    console.log(so_luong);
                                    $('#so_luong').val(so_luong)
                                }
                            })
                        })
                    })
                </script>
                <div hidden class="mb-3">
                    <label for="" class="form-label">Trạng thái</label>
                    <input class="form-control" value="3" name="status" id="trang_thai" type="text">
                </div>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>
@endsection

{{-- @section('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#id_khoa_hoc', function (event) {
                console.log(1)
                const url = $(this).data('url')
                const data = $(this).val();
                console.log(url, data);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id_khoa_hoc: data
                    },
                    success: function (res) {
                        console.log(res)
                        let htmls="<option>--Chọn Lớp--</option>"
                        let ten_lop=Object.values(res.lop);
                        console.log(res.lop);
                        ten_lop.forEach(function (item) {
                            console.log(item)
                            htmls+=` <option  value="${ item.id }">${ item.ten_lop }</option>`
                        })
                        $('#id_gia').val(res.gia_khoa_hoc)
                        $('#gia_khoa_hoc').val(res.gia_khoa_hoc)
                        $('#id_lop').html(htmls)
                    }
                })
            })
        })
    </script>
@endsection --}}
