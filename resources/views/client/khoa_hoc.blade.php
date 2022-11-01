@extends('Client.templates.layout')
@section('title') - Courses
@endsection
@section('content')
<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Courses</h2>
            <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
        <div class="container" data-aos="fade-up">

            <div class="row" data-aos="zoom-in" data-aos-delay="100">

                @foreach($list as $key => $item)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="course-item">
                        <img src="{{ asset('plugins/assets/img/course-1.jpg') }}" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Web Development</h4>
                                <p class="price">{{ $item -> gia_khoa_hoc }} VNĐ</p>
                            </div>

                            <h3><a href="{{route('route_FE_Homeroute_FE_Khoa_Hoc_Chi_Tiet',['id' => $item->id])}}">{{ $item -> ten_khoa_hoc }}</a></h3>
                            <p>{{ $item -> mo_ta }}</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="{{ asset('plugins/assets/img/trainers/trainer-1.jpg') }}" class="img-fluid" alt="">
                                    <span>Antonio</span>
                                </div>
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bx bx-user"></i>&nbsp;50
                                    &nbsp;&nbsp;
                                    <i class="bx bx-heart"></i>&nbsp;65
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
                @endforeach
            </div>

        </div>
    </section><!-- End Courses Section -->

</main><!-- End #main -->

@endsection
