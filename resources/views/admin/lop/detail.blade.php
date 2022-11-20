@extends('Admin.templates.layout')

@section('form-search')
    {{route('route_BE_Admin_List_Lop')}}
@endsection

@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Add_Lop') }}">
            <button class='btn btn-success'>  <i class="fas fa-plus "></i> Thêm</button>
        </a>
    </div>
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
    <div>
          {!! $lich  !!}
    </div>
@endsection
