
@extends('client.templates.layout')
@section('title') - About
@endsection
@section('content')
    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Signup Form</h3>
                    <h4><a href="index-2.html"> Home </a> <span> &vert; </span> Signup </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/    
==================================================-->



    <!-- Start: Account Section 
==================================================-->
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reg_wrap">
                        <!-- Start: Image -->
                        <div class="reg_img">
                            <img src="images/hero-men.png" alt="">
                        </div>

                        <!-- Start:  Signup  Form  -->
                        <div class="registration-form">
                            <h2> New User Signup! </h2>
                            <form method="post">
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="fname" id="fname" type="text"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="email" id="remail" type="text"
                                            placeholder="Email address">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="password" id="password" type="text"
                                            placeholder="Password">
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="cpassword" id="cpassword" type="text"
                                            placeholder="Confirm Password">
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <input class="signup-field" name="adddress" id="address" type="text"
                                            placeholder="Address">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="city" id="city" type="text"
                                            placeholder="Town/City">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="signup-field" name="zip" id="zip" type="text"
                                            placeholder="Postcode/Zip">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="term-and-condition">
                                            <input type="checkbox" id="term">
                                            <label for="term">I agree to <a href="#">term &amp; condition</a> and <a
                                                    href="#">privacy policy</a></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 submit-area">
                                        <a href="#" class="submit more-link"> Sign Up </a>
                                        <div id="msg" class="message"></div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- End:Signup Form  -->
                    </div>
                    <!-- .col-md-6 .col-sm-12 /- -->
                </div>
            </div>
            <!-- row /- -->
        </div>
        <!-- container /- -->
    </section>
    <!-- End : Account Section 
==================================================-->

@endsection
