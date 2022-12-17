@extends('client.profile.layout')
@section('title')
    Đổi mật khẩu
@endsection
@section('content')

    <h2 class="font-family-awesome font-size-40">Đổi mật khẩu</h2>
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
        <div class="row justify-content-center">
            <div class="col-8 box-shadow br-15 p-3">
                <form method="post" enctype="multipart/form-data" action="{{ route('client_update_doi_mat_khau') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 font-weight-bold pt-2">
                            <label for="old_password">Mật khẩu cũ</label>
                            <input class="form-control" type="password" name="old_password" id="old_password" value="">
                        </div>
                        @error('old_password')
                        <span style="color: red"> {{ $message }} </span>
                        @enderror

                        <div class="col-12 font-weight-bold pt-2">
                            <label for="new_password">Mật khẩu mới</label>
                            <input class="form-control" type="password" name="new_password" id="new_password" value="">
                        </div>
                        @error('new_password')
                        <span style="color: red"> {{ $message }} </span>
                        @enderror

                        <div class="col-12 font-weight-bold pt-2">
                            <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="">
                        </div>
                        @error('password_confirmation')
                        <span style="color: red"> {{ $message }} </span>
                        @enderror

                        <div class="col-3 pt-4">
                            <button class="btn btn-success" type="submit" style="border-radius: 10px">Cập nhật</button>
                        </div>

                        <div class="col-3 p-0 pt-4">
                            <a href=" {{ route('client_thong_tin_ca_nhan') }}">
                                <button class="btn btn-danger" type="button" style="border-radius: 10px">Hủy</button>
                            </a>

                        </div>

                    </div>

                    <div class="w-100" style="height: 15px"></div>
                </form>
            </div>
        </div>

    </div>

@endsection
