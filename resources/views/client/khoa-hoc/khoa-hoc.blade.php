@extends('Client.templates.layout')
@section('title') - Courses
@endsection
@section('content')
    
    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Contact Us</h3>
                    <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Contact </h4>
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
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck1">
                                    <label class="cat-check-label" for="catCheck1">
                                        All
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck2">
                                    <label class="cat-check-label" for="catCheck2">
                                        Development
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck3">
                                    <label class="cat-check-label" for="catCheck3">
                                        Design
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck4">
                                    <label class="cat-check-label" for="catCheck4">
                                        Creative
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck5">
                                    <label class="cat-check-label" for="catCheck5">
                                        Accounting
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck6">
                                    <label class="cat-check-label" for="catCheck6">
                                        Finance
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck7">
                                    <label class="cat-check-label" for="catCheck7">
                                        Legal
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck8">
                                    <label class="cat-check-label" for="catCheck8">
                                        Photography
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck9">
                                    <label class="cat-check-label" for="catCheck9">
                                        Writing
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck10">
                                    <label class="cat-check-label" for="catCheck10">
                                        Translation
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="checkbox" value="" id="catCheck11">
                                    <label class="cat-check-label" for="catCheck11">
                                        Marketing
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end: Category Widget-->

                    <div class="course_price_sidebar">
                        <h4 class="course_cat_title">Price Level</h4>
                        <ul>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="radio" value="" id="priceCheck1" checked=""
                                        name="priceCheck">
                                    <label class="cat-check-label" for="priceCheck1">
                                        Free
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_cat_check">
                                    <input class="cat-check-input" type="radio" value="" id="priceCheck2" checked=""
                                        name="priceCheck">
                                    <label class="cat-check-label" for="priceCheck2">
                                        Paid
                                    </label>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end: Price Level Widget-->

                    <div class="course_instructor_sidebar">
                        <h4 class="course_cat_title">Instructor </h4>
                        <ul>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value="" id="instructorCheck1"
                                        name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck1">
                                        Ben Stcoks
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value="" id="instructorCheck2"
                                        name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck2">
                                        Adam Crew
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value="" id="instructorCheck3"
                                        name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck3">
                                        Moris Jon
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value="" id="instructorCheck4"
                                        name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck4">
                                        Yalina De
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="instructor-check-input" type="checkbox" value="" id="instructorCheck5"
                                        name="instructor">
                                    <label class="instructor-check-label" for="instructorCheck5">
                                        Alex Carry
                                    </label>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end: Instructor Widget-->

                    <div class="course_lang_sidebar">
                        <h4 class="course_cat_title">Language </h4>
                        <ul>
                            <li>
                                <div class="course_language_check">
                                    <input class="language-check-input" type="checkbox" value="" id="languageCheck1"
                                        name="language">
                                    <label class="language-check-label" for="languageCheck1">
                                        English
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="language-check-input" type="checkbox" value="" id="languageCheck2"
                                        name="language">
                                    <label class="language-check-label" for="languageCheck2">
                                        Spanish
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="language-check-input" type="checkbox" value="" id="languageCheck3"
                                        name="language">
                                    <label class="language-check-label" for="languageCheck3">
                                        Bengali
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="language-check-input" type="checkbox" value="" id="languageCheck4"
                                        name="language">
                                    <label class="language-check-label" for="languageCheck4">
                                        Portuguese
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="course_instructor_check">
                                    <input class="language-check-input" type="checkbox" value="" id="languageCheck5"
                                        name="language">
                                    <label class="language-check-label" for="languageCheck5">
                                        Russian
                                    </label>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end: Language Widget-->
                </div>
                <!-- end: col-sm-12 col-lg-3-->

                <!--  Start: col-sm-12 col-lg-9 -->
                <div class="col-sm-12 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12 cat_search_filter">
                            <div class="cat_search">
                                <div class="widget widget-search">
                                    <!-- input-group -->
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search" type="text">
                                        <span class="input-group-btn">
                                            <button type="button"><i class="pe-7s-search"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>
                            <!-- End: Search -->
                            <div class="cat_selectbox">
                                <div class="select-box">
                                    <select class="form-select" aria-label="select">
                                        <option selected="">Most Viewed</option>
                                        <option value="1">Java programming</option>
                                        <option value="2">Designer</option>
                                        <option value="3"> English </option>
                                    </select>
                                </div>
                            </div>
                            <!-- end: select box -->
                            <div class="cat_item_count">
                                Showing 1-8 of 22 results
                            </div>
                        </div>
                        <!--  End: Search Filter -->

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses1.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> Development </span>
                                    <span class="feat_cour_p"> $170 </span>
                                </div>
                                <h4 class="feat_cour_tit"> Become a professional designer be
                                    with passion & dignity </h4>
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
                                    <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                </div>
                            </div>
                        </div>
                        <!-- /. col-lg-4 col-md-6 col-sm-12-->

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses2.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> UI/UX Design </span>
                                    <span class="feat_cour_p"> $180 </span>
                                </div>
                                <h4 class="feat_cour_tit"> Java programming A-Z fully classes
                                    with full task </h4>
                                <div class="feat_cour_lesson">
                                    <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 24 lessons </span>
                                    <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 259 Students </span>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses3.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> Art & Craft </span>
                                    <span class="feat_cour_p"> $370 </span>
                                </div>
                                <h4 class="feat_cour_tit"> You will fell in love with this mustly
                                    if you have desire
                                </h4>
                                <div class="feat_cour_lesson">
                                    <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 25 lessons </span>
                                    <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 537 Students </span>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses4.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> Lifestyle </span>
                                    <span class="feat_cour_p"> $370 </span>
                                </div>
                                <h4 class="feat_cour_tit"> Be passionated with your regularly
                                    exercise and stay fit </h4>
                                <div class="feat_cour_lesson">
                                    <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 30 lessons </span>
                                    <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 337 Students </span>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses5.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> Business </span>
                                    <span class="feat_cour_p"> $470 </span>
                                </div>
                                <h4 class="feat_cour_tit"> Grow your business by mastered in
                                    some technique</h4>
                                <div class="feat_cour_lesson">
                                    <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 40 lessons </span>
                                    <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 737 Students </span>
                                </div>
                                <div class="feat_cour_rating">
                                    <span class="feat_cour_rat">
                                        4.2
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        (1,5559)
                                    </span>
                                    <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                </div>
                            </div>
                        </div>
                        <!-- /. col-lg-4 col-md-6 col-sm-12-->

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="feat_course_item">
                                <img src="images/courses6.jpg" alt="image">
                                <div class="feat_cour_price">
                                    <span class="feat_cour_tag"> Marketing </span>
                                    <span class="feat_cour_p"> $570 </span>
                                </div>
                                <h4 class="feat_cour_tit"> Top 10 tips to grow up audience to
                                    progress business </h4>
                                <div class="feat_cour_lesson">
                                    <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 70 lessons </span>
                                    <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 537 Students </span>
                                </div>
                                <div class="feat_cour_rating">
                                    <span class="feat_cour_rat">
                                        4.9
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        (4,4000)
                                    </span>
                                    <a href="single-course.html"> <i class="arrow_right"></i> </a>
                                </div>
                            </div>
                        </div>
                        <!-- /. col-lg-4 col-md-6 col-sm-12-->
                    </div>

                    <nav class="cat-page-navigation">
                        <ul class="pagination">
                            <li class="pagination-arrow"><a href="#"><i class="fal fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">3</a></li>
                            <li class="pagination-arrow"><a href="#"><i class="fal fa-angle-double-right"></i></a></li>
                        </ul>
                    </nav>
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
