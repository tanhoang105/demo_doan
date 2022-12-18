@extends('Client.templates.layout')
@section('title') - Giảng viên
@endsection
@section('content')


    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>THÔNG TIN GIẢNG VIÊN</h3>
                    <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Instructor Details </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/    
==================================================-->



    <!-- Start: Teacher Section
==================================================-->
    <section class="single-teacher-section">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="teacher_left">
                        <div class="teacher_avatar">
                            <img src="{{ Storage::url($giang_vien->hinh_anh) }}" alt="">
                            <h3> {{$giang_vien->ten_giang_vien}} </h3>
                            <span> {{$giang_vien->email}}</span>
                            <span>{{$giang_vien->sdt}}</span>
                        </div>

                        <div class="teacher_achieve" >
                            
                        </div>

                    </div>
                   
                <!-- /. col-lg-4 col-md-5 col-sm-12 -->


                <!-- /. col-lg-8 col-md-7 col-sm-12 -->
            </div> --}}
        

            <div class="row">
                <div class="teacher_about">
                    <h3> Giới thiệu</h3>
                    <p>{!! $giang_vien->mo_ta !!}</p>
                </div>
            </div>
            <!-- /. row -->
        </div>
        <!-- /. container -->
    </section>
    <!--   End: Teacher Section
==================================================-->


@endsection
