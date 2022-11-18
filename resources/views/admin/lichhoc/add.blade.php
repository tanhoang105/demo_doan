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
    <form class="p-5" action=" {{ route('route_BE_Admin_Add_Ca_Thu') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Ca Học</label>
                    <select name="ca_id" class="form-control" id="">
                        @foreach ($ca as $item)
                            <option value="{{ $item->id }}"> {{ $item->ca_hoc }} </option>
                        @endforeach
                    </select>
                    @error('ca_id')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    {{-- <label for="" class="form-label">Thứ</label> --}}

                    @foreach ($thuhoc as $item)
                        <div>
                            <input value="{{ old($item->id) ?? (request()->id ?? $item->id) }}"
                                type="checkbox" name="thu_hoc_id[]" id="" aria-describedby="emailHelp">
                            {{ $item->ten_thu }}
                        </div>
                    @endforeach

                    @error('thu_hoc_id')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror



                </div>



            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>



    </form>
    {{-- <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script> --}}
@endsection
