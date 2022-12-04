@extends('Client.templates.layout')
@section('title') - Trainers
@endsection
@section('content')

    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Giảng Viên</h3>
                    <h4><a href="{{ route('home') }}"> Trang Chủ </a> <span> &vert; </span> Giảng Viên </h4>
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
    <section class="teacher-section">
        <div class="container">
            <div class="row">
              @foreach ($giang_vien as $value )
              <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- teacher-list -->
                <div class="teacher-img">
                    <img src="{{ Storage::url($value->hinh_anh) }} " alt="image">
                </div>
                <div class="teacher-info">
                    <div class="teacher-social">
                        <ul>
                            <li>
                                <a href="#" class="fab fa-facebook-f"></a>
                            </li>
                            <li>
                                <a href="#" class="fab fa-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="fab fa-linkedin-in"></a>
                            </li>
                            <li>
                                <a href="#" class="fab fa-skype"></a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{route('client_chi_tiet_giang_vien',$value->id)}}">
                        <h4>{{$value->ten_giang_vien}} </h4>
                    </a>
                    <p> Developer</p>
                </div>
                <!-- End: .teacher-list -->
            </div>
              @endforeach
            </div>
            {{-- <div class="row teacher_partner">
                <div class="partner_col">
                    <span>Cơ hội đặc biệt</span>
                    <h2> Trở thành một Instractor</h2>
                    <a href="contact.html" class="more-link"> Liên Hệ Chúng Tôi </a>
                </div>
                <div class="partner_col">
                    <span>Cơ hội đặc biệt</span>
                    <h2> Tham gia cộng đồng chúng tôi</h2>
                    <a href="contact.html" class="more-link"> Liên Hệ Chúng Tôi </a>
                </div>
            </div> --}}
            <!-- /. row -->
        </div>
        <!-- /. container -->
    </section>
    <!--   End: Teacher Section
=================

@endsection
