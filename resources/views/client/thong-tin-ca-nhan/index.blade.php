@extends('client.profile.layout')
@section('title')
    Thông tin cá nhân
@endsection
@section('content')

    <h2>Hồ sơ</h2>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            {{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
            {{--                <span aria-hidden="true">&times;</span>--}}
            {{--                <span class="sr-only">Close</span>--}}
            {{--            </button>--}}
        </div>
    @endif

    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            {{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
            {{--                <span aria-hidden="true">&times;</span>--}}
            {{--                <span class="sr-only">Close</span>--}}
            {{--            </button>--}}
        </div>
    @endif
    <div class="profile">
        <form method="post" enctype="multipart/form-data" action="{{ route('client_thong_tin_ca_nhan_update') }}">
            @csrf
        <div class="row">
            <div class="col-4 box-shadow br-15" style="width: 390px;margin-right: 20px;">
                <div class="avatar d-flex justify-content-center pt-2">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" name="hinh_anh" id="imageUpload" accept=".png, .jpg, .jpeg" value="{{ Storage::url(Auth::user()->hinh_anh) }}"/>
                            <label for="imageUpload"></label>
                        </div>
                        <img class="rounded-circle box-shadow" src="{{ Storage::url(Auth::user()->hinh_anh) }}" style="width: 130px;height: 130px;">
                    </div>

                </div>

{{--                <div class="row d-flex justify-content-center pt-3" style="margin-right: 10px;">--}}
{{--                    <div class="col-3 d-flex flex-column">--}}
{{--                        <label class="d-flex justify-content-center">0</label>--}}
{{--                        <span class="d-flex justify-content-center">Khóa học</span>--}}
{{--                    </div>--}}
{{--                    <div class="col-2 d-flex flex-column">--}}
{{--                        <label class="d-flex justify-content-center">0</label>--}}
{{--                        <span class="d-flex justify-content-center">Lớp</span>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>

            <div class="col-8 box-shadow br-15 p-3" style="height: 250px;">

                    <div class="row">
                        <div class="col-6 font-weight-bold pt-2">
                            <label>Họ tên</label>
                            <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                        </div>

                        <div class="col-6 font-weight-bold pt-2">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="col-6 font-weight-bold pt-3">
                            <label>Điện thoại</label>
                            <input class="form-control" type="text" name="sdt" value="{{ Auth::user()->sdt }}">
                        </div>

                        <div class="col-6 font-weight-bold pt-3">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="dia_chi" value="{{ Auth::user()->dia_chi }}">
                        </div>

                        <div class="col-2 pt-4">
                            <button class="btn btn-success" type="submit">Cập nhật</button>
                        </div>

                        <div class="col-3 p-0 pt-4">
                            <a href=" {{ route('client_doi_mat_khau') }}">
                                <button class="btn btn-primary" type="button">Đổi mật khẩu</button>
                            </a>

                        </div>

                    </div>
            </div>

        </div>
        </form>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script id="rendered-js" >
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function () {
            readURL(this);
        });
        //# sourceURL=pen.js
    </script>
@endsection
