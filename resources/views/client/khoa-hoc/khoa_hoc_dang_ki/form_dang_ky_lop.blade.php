@extends('client.profile.layout')
@section('title')
    Đăng kí đổi khóa học
@endsection
@section('content')
    <div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>

    <div class="container">
        <h2>Đăng kí đổi khóa học</h2>
        <form action="{{ route('doi_khoa_hoc') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Khóa học cũ</label>
                    @foreach ($khoa_hoc_cu as $item)
                        <input type="text" class="form-control" value="{{ $item->ten_khoa_hoc }}" disabled>
                    @endforeach
                    <input type="text" name="id_lop_cu" value="{{ $lop_cu }}" hidden>
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Khóa học mới</label>
                    <input type="text" class="form-control" value="{{ $khoa_hoc_moi->ten_khoa_hoc }}" disabled>
                </div>

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lớp học mới</label>
                    <select data-url="{{ route('siso_doilop') }}" class="form-control" name="id_lop_moi" id="id_lop_moi">
                        <option value="">-----Chọn lớp mới muốn đổi------</option>
                        @foreach ($lop_moi as $value)
                            <option value="{{ $value->id }}">{{ $value->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Ghế trống</label>
                    <input disabled class="form-control" name="so_luong" id="so_luong" type="text">
                </div> --}}

                <div class="col-lg-12 font-weight-bold pt-2">
                    <label class="">Lý do</label>
                    <textarea class="form-control" style="height: 150px;" name="ly_do" placeholder="Lý do bạn muốn đổi lớp"></textarea>
                </div>

                <div class="pt-2">
                    <input type="text" name="status" id="" value="2" hidden>
                    <input type="text" name="id_user" id="" value="{{ Auth::user()->id }}" hidden>
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn đổi lóp ')" class="btn btn-primary">Gửi
                        yêu cầu </button>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#id_lop_moi', function(event) {
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
                        let so_luong = res;
                        $('#so_luong').val(res)
                    }
                })

            })
        })
    </script>
@endsection
