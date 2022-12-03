@extends('Admin.templates.layout')
@section('content')
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('msg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('msg') }}</strong>
        </div>
    @endif
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Dang_Ky',$loadDangKy->id) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">
                <input class="signup-field" name="gia_khoa_hoc" id="gia_khoa_hoc" type="text" value="" hidden>
                <div class="mb-3">
                    <label for="" class="form-label">Tên </label>
                    <input class="form-control" value="{{$loadDangKy->name}}" name="name" id="name" type="text" placeholder="Tên">
                    @error('name')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email </label>
                    <input class="form-control" value="{{$loadDangKy->email}}" name="email" id="email" type="text" placeholder="Email">
                    @error('email')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sđt </label>
                    <input class="form-control" value="{{$loadDangKy->sdt}}" name="sdt" id="sdt" type="text" placeholder="Số điện thoại">
                    @error('sdt')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ </label>
                    <input class="form-control" value="{{$loadDangKy->dia_chi}}" name="dia_chi" id="dia_chi" type="text" placeholder="Địa chỉ">
                    @error('dia_chi')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Khóa học </label>
                    <input type="text" name="ten_khoa_hoc" id="" disabled value="{{$loadDangKy->ten_khoa_hoc}}" class="form-control">
                    @error('id_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp </label>
                   <input type="text" name="lop" value="{{$loadDangKy->ten_lop}}" class="form-control" disabled>
                    @error('id_lop')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Trạng thái thanh toán </label>
                    <select name="id_thanh_toan" id="" class="form-control select-control">
                        <option value="2" {{$loadDangKy->trang_thai == 2 ? 'selected' : ''}}>Đã thanh toán</option>
                        <option value="1" {{$loadDangKy->trang_thai == 1 ? 'selected' : ''}}>Chưa thanh toán</option>
                    </select>
                    @error('id_lop')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Học phí</label>
                    <input class="form-control" name="" id="id_gia" type="text" value="{{$loadDangKy->gia_khoa_hoc}}" disabled>

                    @error('id_gia')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_List_Dang_Ky')}} ">Quay lại </a>
       

    </form>
@endsection

@section('js')
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
@endsection
