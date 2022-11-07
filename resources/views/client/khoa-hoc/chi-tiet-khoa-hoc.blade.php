@extends('Client.templates.layout')
@section('title')
    - Course Details
@endsection
@section('content')
    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Single Course</h3>
                    <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Courses </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/
            ==================================================-->


    <!-- Start : Blog Page Content
            ==================================================-->
    <div class="single_course">
        <div class="container">
            <div class="row">
                <!-- Blog Area -->
                <div class="col-lg-8 col-sm-12">
                    <div class="sing_course_wrap">
                        <div class="sin_course_img">
                            <img class="img-responsive" src="{{ asset('client/images/blog3.jpg') }}" alt="">
                        </div>
                        <h4>{{ $detail->ten_khoa_hoc }}</h4>
                        <div class="course_meta">
                            <img src="{{ asset('client/images/author2.png') }}">
                            <p>Nelson Mandela</p>
                            <span class="sin_cour_stu"> <i class="fal fa-graduation-cap"></i> 20,153 Students </span>
                            <span class="sin_cour_rat">
                                4.7
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                (4,5609)
                            </span>
                        </div>

                        <div class="course_tab">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" id="pills-discription-tab" data-bs-toggle="tab"
                                        data-bs-target="#pills-discription" role="tab" aria-controls="pills-discription"
                                        aria-selected="true" type="button">Mô tả</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="pills-instructors-tab" data-bs-toggle="tab"
                                        data-bs-target="#pills-instructors" role="tab" aria-controls="pills-instructors"
                                        aria-selected="false" type="button">Các lớp học</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="pills-curriculum-tab" data-bs-toggle="tab"
                                        data-bs-target="#pills-curriculum" role="tab" aria-controls="pills-curriculum"
                                        aria-selected="false" type="button">Chương trình</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#pills-reviews" role="tab" aria-controls="pills-reviews"
                                        aria-selected="false" type="button">Nhận xét</button>
                                </li>
                            </ul>
                            <div class="tab-content course_tab_cont" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-discription"
                                    aria-labelledby="pills-discription-tab" role="tabpanel">
                                    <span> Mô tả : </span>
                                    <p>
                                        {{ $detail->mo_ta }}
                                    </p>
                                    <div class="share_course">
                                        <span> Chia sẻ khóa học : </span>
                                        <a href="#" class="fab fa-facebook-f"></a>
                                        <a href="#" class="fab fa-pinterest"></a>
                                        <a href="#" class="fab fa-twitter"></a>
                                        <a href="#" class="fa fa-link"></a>
                                    </div>
                                </div>
                                <!-- End:: discription-tab  -->
                                <div class="tab-pane fade" id="pills-curriculum" aria-labelledby="pills-curriculum-tab"
                                    role="tabpanel">
                                    <span> Curriculum : </span>
                                    <p>
                                        E learning dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                                        vero eos keti accusam et justo duo dolores et ea rebum. Stet clita kasd
                                        gubergren, no sea takimel.
                                        sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                                        done sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                                        dolore magna valiquyam erat, sed diam voluptua. At vero eos et accusam et justo
                                        duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                                        Lorem ipsum dolor sit.
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.
                                        E learning dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                                        vero eos keti accusam et justo duo dolores et ea rebum. Stet clita kasd
                                        gubergren, no sea takimel.
                                        sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                                        done sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                                        dolore facts.
                                        E learning dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                                        vero eos keti accusam et justo duo dolores et ea rebum. Stet clita kasd
                                        gubergren, no sea takimel.
                                        sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                                        done sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                                        dolore facts.
                                    </p>
                                    <div class="share_course">
                                        <span> Share Course : </span>
                                        <a href="#" class="fab fa-facebook"></a>
                                        <a href="#" class="fab fa-pinterest"></a>
                                        <a href="#" class="fab fa-twitter"></a>
                                        <a href="#" class="fa fa-link"></a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-instructors" aria-labelledby="pills-instructors-tab"
                                    role="tabpanel">
                                    <span> Các lớp học để học viên đăng kí : </span>
                                    {{-- <div class="course_instractor">
                                    </div> --}}
                                    <table class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Tên Lớp </th>
                                                <th scope="col">Giá </th>
                                                <th scope="col">Số lượng học viên </th>
                                                <th scope="col">Ngày bắt đầu </th>
                                                <th scope="col">Ngày kết thúc </th>
                                                <th scope="col">Giảng viên </th>
                                                <th> Hành động </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lop as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td> {{ $item->ten_lop }}</td>
                                                    <td> {{ $item->gia }}</td>
                                                    <td> {{ $item->so_luong }}</td>
                                                    <td> {{ $item->ngay_bat_dau }}</td>
                                                    <td> {{ $item->ngay_ket_thuc }}</td>
                                                    <td>
                                                        @foreach ($lop as $gv)
                                                            @if ($item->id_giang_vien == $gv->id)
                                                                <a style="color: blue"
                                                                    href="{{ route('client_chi_tiet_giang_vien',['id' => $item->id_giang_vien]) }}">{{ $gv->ten_giang_vien }}</a>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('client_dang_ky') }}">
                                                            <input name="id_khoa_hoc" value="{{ $detail->id }}" hidden>
                                                            <input name="id_lop" value="{{ $item->id }}" hidden>
                                                            <input name="gia_khoa_hoc"
                                                                value="{{ $detail->gia_khoa_hoc }}" hidden>
                                                            <button style="width: 100px" class="btn btn-primary">Đăng
                                                                kí</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-reviews" aria-labelledby="pills-reviews-tab"
                                    role="tabpanel">
                                    <span> Students Reviews :</span>

                                    <div id="revCarousel" class="carousel slide sturev_carousel" data-bs-ride="carousel">

                                        <div class="carousel-item sturev_item active">
                                            <!-- Start: Heading -->
                                            <div class="sturev_wrap">
                                                <img src="images/instructor4.png" alt="">
                                                <div class="sturev_name">
                                                    <h4>Beckham Davis</h4>
                                                    <span> UI Designer</span>
                                                </div>
                                                <span class="sturev_rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </div>
                                            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy
                                                eirmod at tempor invidunt ut labore et dolore magna aliquyam erat,
                                                sed
                                                diam voluptua. At vero eos et accusam et justo duo dolores et ea
                                                rebum.
                                                Stet clita kasd gubergren veccens.</p>
                                        </div>
                                        <div class="carousel-item sturev_item">
                                            <!-- Start: Heading -->
                                            <div class="sturev_wrap">
                                                <img src="images/instructor4.png" alt="">
                                                <div class="sturev_name">
                                                    <h4>Beckham Davis</h4>
                                                    <span> UI Designer</span>
                                                </div>
                                                <span class="sturev_rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </div>
                                            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy
                                                eirmod at tempor invidunt ut labore et dolore magna aliquyam erat,
                                                sed
                                                diam voluptua. At vero eos et accusam et justo duo dolores et ea
                                                rebum.
                                                Stet clita kasd gubergren veccens.</p>
                                        </div>
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#revCarousel" data-bs-slide-to="0"
                                                class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#revCarousel" data-bs-slide-to="1"
                                                aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#revCarousel" data-bs-slide-to="2"
                                                aria-label="Slide 3"></button>
                                        </div>
                                    </div>
                                    <!--/ col-md-12  -->
                                    <div class="review_form">
                                        <span> Write A Review</span>
                                        <form method="post" action="https://santhemes.com/tidytheme/aducat/mailer.php"
                                            id="contact-form">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <input class="con-field" name="name" id="rname"
                                                        type="text" placeholder="Name">
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <input class="con-field" name="email" id="remail"
                                                        type="text" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 rev_textarea">
                                                    <textarea class="con-field" name="message" id="rmessage" rows="6" placeholder="Your Comment"></textarea>
                                                    <span class="sin_cour_rat">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 submit-area">
                                                    <input type="submit" class="submit-contact" value="Submit">
                                                    <div id="msg" class="message"></div>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/ article -->
                </div>
                <!--/ Left Side Area -->

                <!-- Widget Area -->
                <div class="col-lg-4 col-sm-12 single_curs_right">
                    <!-- Widget Course Details -->
                    <aside class="widget-course-details">
                        <h2> Giá tiền <span>{{ number_format($detail->gia_khoa_hoc) }}</span></h2>
                        <div class="course-detail-list">
                            <span> <i class="far fa-user"></i>Tên khóa học </span>
                            <span> {{$detail->ten_khoa_hoc}} </span>
                        </div>
                        {{-- <div class="course-detail-list">
                            <span> <i class="far fa-clock"></i>Duration </span>
                            <span> 07 hr 20 mins </span>
                        </div> --}}
                        {{-- <div class="course-detail-list">
                            <span> <i class="far fa-journal-whills"></i>Lectures </span>
                            <span> 32 </span>
                        </div>
                        <div class="course-detail-list">
                            <span> <i class="far fa-layer-group"></i>Level </span>
                            <span> Advance </span>
                        </div> --}}
                        <div class="course-detail-list">
                            <span> <i class="far fa-globe"></i>Trạng thái </span>
                            <span> @if ($detail->id_danh_muc == 1)
                                Đang hoạt động
                                @else
                                Không hoạt động
                            @endif </span>
                        </div>
                        <div class="course-detail-list">
                            <span> <i class="far fa-book-spells"></i>Danh mục khóa học </span>
                            @foreach ($danhmuc as $value )
                            <span>{{$value->ten_danh_muc}}</span>
                            @endforeach
                        </div>
                        <a href="#" class="more-link"> Buy Now</a>
                    </aside>
                    <!-- Widget Course Details /- -->

                    <!-- Related Courses -->
                    <aside class="widget-rel-course">
                        <h3>Khóa học liên quan </h3>
                        <div class="row">
                        @foreach ($khoahoclienquan as $value )
                        {{-- <div class="rel-course-box">
                            <a href="#"><img src="{{asset('client/images/courses2.jpg')}}" width="200px" alt=""></a>  
                            <span><a href="">{{$value->ten_khoa_hoc}}</a></span> 
                            <span></span>
                        </div> --}}
                        <div style="display: flex" class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="{{ asset('client/images/courses1.jpg') }}" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag">Giá tiền {{$value->gia_khoa_hoc}}</span>
                                    {{-- <span class="feat_cour_p">{{$value->gia_khoa_hoc}}</span> --}}
                                </div>
                                <div class="feat_cour_rating">
                                    <h4 class="feat_cour_tit">{{$value->ten_khoa_hoc}}</h4>
                                    <a href="{{route('client_chi_tiet_khoa_hoc',$value->id)}}"> <i class="arrow_right"></i> </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </aside>
                    <!-- Related Courses /- -->
                </div>
                <!-- Widget Area /- -->
            </div>
        </div>
        <!-- Container /- -->
    </div>
    <!-- End : Blog Page Content
            ==================================================-->
@endsection
