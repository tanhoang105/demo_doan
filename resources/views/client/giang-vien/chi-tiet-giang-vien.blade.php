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
                    <h3>Instructor Details</h3>
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
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="teacher_left">
                        <div class="teacher_avatar">
                            <img src="images/teacher1.jpg" alt="">
                            <h3> Jon Andarson </h3>
                            <span> Web Devekoper</span>
                            <span> andarson@aducat.com</span>
                            <span> +(222) 3456 278 </span>
                        </div>
                        <div class="teacher_social">
                            <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-linkedin"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-youtube"></a>
                        </div>
                        <div class="teacher_achieve">
                            <div class="teacher_achieve_list">
                                <i class="fal fa-user-friends"></i>
                                <h3> 56,890 </h3>
                                <span> Students </span>
                            </div>
                            <div class="teacher_achieve_list">
                                <i class="fal fa-star"></i>
                                <h3> 5.0 </h3>
                                <span> Rating </span>
                            </div>
                            <div class="teacher_achieve_list">
                                <i class="fal fa-book-open"></i>
                                <h3> 80 </h3>
                                <span> Courses </span>
                            </div>
                        </div>
                        <div class="teacher_about">
                            <h3> About Me</h3>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipi sicing elit. Aut animi sed labo rum. Nam
                                esse
                                ipsum ab mole stias rem corr upti moles tiae expe dita hic aspe riores eius, vitae unde
                                neces sitat ibus, mai ore bland itiis magni.</p>
                        </div>
                    </div>
                </div>
                <!-- /. col-lg-4 col-md-5 col-sm-12 -->

                <div class="col-lg-8 col-md-7 col-sm-12 teach_course_tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="course-tab" data-bs-toggle="tab"
                                data-bs-target="#course" type="button" role="tab" aria-controls="course"
                                aria-selected="true">Course List </button>
                        </li>
                        <!-- end: ourse-tab -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                        <!-- end: reviews-tab -->
                    </ul>
                    <!-- End:  nav-tabs -->

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="course" role="tabpanel" aria-labelledby="course-tab">
                            <div class="row teacher_course">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="images/courses1.jpg" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag"> Development </span>
                                            <span class="feat_cour_p"> $170 </span>
                                        </div>
                                        <h4 class="feat_cour_tit"> Become a professional designer be
                                            with passion &amp; dignity </h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 20 lessons
                                            </span>
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
                                            <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. col-lg-4 col-md-6 col-sm-12-->

                                <div class="col-lg-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="images/courses2.jpg" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag"> UI/UX Design </span>
                                            <span class="feat_cour_p"> $180 </span>
                                        </div>
                                        <h4 class="feat_cour_tit"> Java programming A-Z fully classes
                                            with full task </h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 24 lessons
                                            </span>
                                            <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 259 Students
                                            </span>
                                        </div>
                                        <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.7
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (4,5609)
                                            </span>
                                            <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. col-lg-4 col-md-6 col-sm-12-->

                                <div class="col-lg-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="images/courses3.jpg" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag"> Art &amp; Craft </span>
                                            <span class="feat_cour_p"> $370 </span>
                                        </div>
                                        <h4 class="feat_cour_tit"> You will fell in love with this mustly
                                            if you have desire
                                        </h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 25 lessons
                                            </span>
                                            <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 537 Students
                                            </span>
                                        </div>
                                        <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.8
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (2,3399)
                                            </span>
                                            <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. col-lg-4 col-md-6 col-sm-12-->

                                <div class="col-lg-6 col-sm-12">
                                    <div class="feat_course_item">
                                        <img src="images/courses4.jpg" alt="image">
                                        <div class="feat_cour_price">
                                            <span class="feat_cour_tag"> Lifestyle </span>
                                            <span class="feat_cour_p"> $370 </span>
                                        </div>
                                        <h4 class="feat_cour_tit"> Be passionated with your regularly
                                            exercise and stay fit </h4>
                                        <div class="feat_cour_lesson">
                                            <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 30 lessons
                                            </span>
                                            <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 337 Students
                                            </span>
                                        </div>
                                        <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.9
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (2,539)
                                            </span>
                                            <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. col-lg-4 col-md-6 col-sm-12-->
                            </div>
                        </div>
                        <!-- End: Course List Content -->

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="row teacher_review">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="lfeedback_text">
                                        <div class="teacher_star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div>
                                        <p> It's Had been a fear most experience me that I feel a great
                                            assumption that never thoughts that will happens to But
                                            great provocatives things appropities received without
                                            realmost qualifier that happen that never thoughts that will happens to a
                                            fear most
                                            experience. </p>
                                        <h4> David Benjamin </h4>
                                        <h5>Washington, United States</h5>
                                    </div>
                                </div>
                                <!-- end: review col-->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="lfeedback_text">
                                        <div class="teacher_star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div>
                                        <p> It's Had been a fear most experience me that I feel a great
                                            assumption that never thoughts that will happens to But
                                            great provocatives things appropities received without
                                            realmost qualifier that happen that never thoughts that will happens to a
                                            fear most
                                            experience. </p>
                                        <h4> David Benjamin </h4>
                                        <h5>Washington, United States</h5>
                                    </div>
                                </div>
                                <!-- end: review col-->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="lfeedback_text">
                                        <div class="teacher_star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div>
                                        <p> It's Had been a fear most experience me that I feel a great
                                            assumption that never thoughts that will happens to But
                                            great provocatives things appropities received without
                                            realmost qualifier that happen that never thoughts that will happens to a
                                            fear most
                                            experience. </p>
                                        <h4> David Benjamin </h4>
                                        <h5>Washington, United States</h5>
                                    </div>
                                </div>
                                <!-- end: review col-->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="lfeedback_text">
                                        <div class="teacher_star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div>
                                        <p> It's Had been a fear most experience me that I feel a great
                                            assumption that never thoughts that will happens to But
                                            great provocatives things appropities received without
                                            realmost qualifier that happen that never thoughts that will happens to a
                                            fear most
                                            experience. </p>
                                        <h4> David Benjamin </h4>
                                        <h5>Washington, United States</h5>
                                    </div>
                                </div>
                                <!-- end: review col-->
                            </div>
                        </div>
                        <!-- End: Reviews Content -->

                    </div>
                </div>
                <!-- /. col-lg-8 col-md-7 col-sm-12 -->
            </div>
            <!-- /. row -->
        </div>
        <!-- /. container -->
    </section>
    <!--   End: Teacher Section
==================================================-->


@endsection
