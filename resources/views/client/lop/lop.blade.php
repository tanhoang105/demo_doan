@extends('client.profile.layout')
@section('title')
    - Lớp
@endsection
@section('content')
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <section class="account-section">
        <div class="container">
            <div class="row">
                @foreach ($list as $value)
                    <div class="col-lg-3 col-md-6 col-sm-12 border rounded">
                        <div class="feat_course_item">
                            <div class="feat_cour_price">
                                <h3> {{ $value->ten_lop }}</h3>
                                <span class="feat_cour_tag"> {{ $value->so_luong }}/40 </span>
                            </div>
                            <div class="pb-4">
                                <div class="">
                                    <span class="p-1"> <i class="fa-solid fa-user bg-white"></i>
                                        {{ $value->ten_giang_vien }} </span>
                                </div>
                                <div class="">
                                    <span class="p-1"> <i class="fa-solid fa-calendar-days"></i>
                                        {{ $value->ngay_bat_dau }} </span>
                                </div>
                                <div class="">
                                    <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> {{ $value->ca_hoc }}
                                    </span>
                                </div>
                                <div class="">
                                    <span>Trang thái: </span>
                                    @if ($value->ngay_bat_dau >= date('Y-m-d'))
                                        <span class="p-1"> <i class="fa-solid fa-alarm-clock"></i> Chưa học
                                        </span>
                                    @else
                                        <a>đã học</a>
                                    @endif

                                </div>
                            </div>
                            <div class="feat_cour_rating">
                                {{-- <a class="btn btn-primary" href="{{route('form_doi_lop',$value->lop_id)}}">Đổi lớp</a> --}}
                                <form action="{{ route('form_doi_lop', $value->lop_id) }}" method="GET">
                                    @csrf
                                    {{-- <input type="date" name="ngaybatdau_lopcu" value="{{$value->ngay_bat_dau}}" id=""> --}}
                                    <input type="text" value="{{ $value->khoa_hoc_id }}" name="khoahoc_id" hidden
                                        id="">
                                    <input type="text" name="xeplop_id" value="{{ $value->id }}" hidden
                                        id="">
                                    @if ($value->ngay_bat_dau >= date('Y-m-d'))
                                        <button class="btn btn-primary">Đổi lớp</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- container /- -->
    </section>
@endsection
