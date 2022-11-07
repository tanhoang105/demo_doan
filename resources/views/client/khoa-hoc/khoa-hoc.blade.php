@extends('Client.templates.layout')
@section('title')
    - Courses
@endsection
@section('content')

    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Các Khóa Học</h3>
                    <h4><a href="{{ route('home') }}"> Trang Chủ </a> <span> &vert; </span> Khóa Học </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/
        ==================================================-->




    <!-- Start: Featured Courses Section
        ==================================================-->
    <section class="course_cat_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-3 course_sidebar">
                    <div class="course_cat_sidebar">
                        <h4 class="course_cat_title">Category</h4>
                        <ul>
                            @foreach ($danhmuc as $value)
                                <li>
                                    <div class="course_cat_check">
                                        {{-- <input class="cat-check-input" type="checkbox" value="" id="catCheck1"> --}}
                                        <label class="cat-check-label" for="catCheck1">
                                            <form action="">
                                                <input hidden type="text" value="{{ $value->id }}" name="id_danhmuc"
                                                    id="">
                                                <button
                                                    style="background: transparent;border: 0">{{ $value->ten_danh_muc }}</button>
                                            </form>
                                        </label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- end: Category Widget-->



                    <div class="course_instructor_sidebar">
                        <h4 class="course_cat_title">Instructor </h4>
                        <ul>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value=""
                                        id="instructorCheck1" name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck1">
                                        Ben Stcoks
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value=""
                                        id="instructorCheck2" name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck2">
                                        Adam Crew
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value=""
                                        id="instructorCheck3" name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck3">
                                        Moris Jon
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value=""
                                        id="instructorCheck4" name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck4">
                                        Yalina De
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value=""
                                        id="instructorCheck5" name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck5">
                                        Alex Carry
                                    </label>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end: Instructor Widget-->
                </div>
                <!-- end: col-sm-12 col-lg-3-->

                <!--  Start: col-sm-12 col-lg-9 -->
                <div class="col-sm-12 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12 cat_search_filter">
                            <div class="cat_search">
                                <div class="widget widget-search">
                                    <!-- input-group -->
                                    <form action="" class="">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Tìm kiếm" name="search"
                                                type="text">
                                            <span class="input-group-btn">
                                                <button type="submit"><i class="pe-7s-search"></i></button>
                                            </span>
                                        </div>
                                    </form>

                                    <!-- /input-group -->
                                </div>
                            </div>
                            <!-- End: Search -->
                            <div class="cat_selectbox">
                                <div class="select-box">
                                    <select class="form-select" aria-label="select">
                                        <option selected="">Xem nhiều nhất</option>
                                        <option value="1">Lập trình Java</option>
                                        <option value="2">Thiết Kế</option>
                                        <option value="3"> Tiếng Anh </option>
                                    </select>
                                </div>
                            </div>
                            <!-- end: select box -->
                            <div class="cat_item_count">
                                Hiển thị 1-8 trong số 22 kết quả
                            </div>
                        </div>
                        <!--  End: Search Filter -->

                        @if (!$id_danhmuc)
                            @foreach ($list as $value)
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="{{ asset('client/images/courses1.jpg') }}" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag">{{ $value->ten_danh_muc }}</span>
                                            <span class="feat_cour_p">{{ $value->gia_khoa_hoc }}</span>
                                        </div>
                                        <h4 class="feat_cour_tit">{{ $value->ten_khoa_hoc }}</h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 20 lessons </span>
                                            <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 237 Students </span>
                                        </div>
                                        <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.6
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (3,539)
                                            </span>
                                            <a href="{{ route('client_chi_tiet_khoa_hoc', $value->id) }}"> <i
                                                    class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <?php
                            $loc_danhmuc = DB::table('khoa_hoc')
                                ->select('khoa_hoc.*', 'danh_muc.ten_danh_muc')
                                ->where('khoa_hoc.id_danh_muc', '=', $id_danhmuc)
                                ->join('danh_muc', 'khoa_hoc.id_danh_muc', '=', 'danh_muc.id')
                                ->get();
                            ?>
                            @foreach ($loc_danhmuc as $value)
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="{{ asset('client/images/courses1.jpg') }}" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag">{{ $value->ten_danh_muc }}</span>
                                            <span class="feat_cour_p">{{ $value->gia_khoa_hoc }}</span>
                                        </div>
                                        <h4 class="feat_cour_tit">{{ $value->ten_khoa_hoc }}</h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 20 lessons </span>
                                            <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 237 Students
                                            </span>
                                        </div>
                                        <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.6
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (3,539)
                                            </span>
                                            <a href="{{ route('client_chi_tiet_khoa_hoc', $value->id) }}"> <i
                                                    class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- /. col-lg-4 col-md-6 col-sm-12-->
                    </div>

                    {{-- <nav class="cat-page-navigation">
                        <ul class="pagination">
                            <li class="pagination-arrow"><a href="#"><i class="fal fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">3</a></li>
                            <li class="pagination-arrow"><a href="#"><i class="fal fa-angle-double-right"></i></a></li>
                        </ul>
                    </nav> --}}
                    <!-- end:  pagination-->
                </div>
            </div>
            <!-- /. row -->
        </div>
        <!-- /. container -->
    </section>
    <!-- End: Featured Courses Section
        ==================================================-->


@endsection
