@extends('Client.templates.layout')
@section('title') - Contact
@endsection
@section('content')

     <!-- header -->
     <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Liên Hệ Với Chúng Tôi</h3>
                    <h4><a href="index-2.html"> Trang Chủ </a> <span> &vert; </span> Liên Hệ </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!-- Start:  contact US  Section
==================================================-->
<section class="contact-section">
    <div class="container">
        <div class="contact_wrp">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-sm-12">
                    <div class="contact_pg_address">
                        <h3>Xin chào, <br>có một dự án?</h3>
                        <div class="single_con_add">
                            <a href="#"><i class="pe-7s-home"></i></a>
                            <p>Địa chỉ công ty :</p>
                            <span>3567 New Alaska, <br> Washington, United State</span>
                        </div>
                        <div class="single_con_add">
                            <a href="#"><i class="pe-7s-mail-open-file"></i></a>
                            <p>Địa chỉ email :</p>
                            <span>example@email .com</span>
                            <span>exmtwo@email .com</span>
                        </div>
                        <div class="single_con_add">
                            <a href="#"><i class="pe-7s-headphones"></i></a>
                            <p>Liên hệ chúng tôi :</p>
                            <span>+84-12-345-6789</span>
                            <span>+84-12-345-6789</span>
                        </div>
                        <div class="contact_social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-sm-12 inner-contact">
                    <!--  Contact Form  -->
                    <div class="contact-form">
                        <h3>Liên Hệ Với Chúng Tôi</h3>
                        <form method="post" action="https://santhemes.com/tidytheme/aducat/mailer.php" id="contact-form">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <input class="con-field" name="name" id="name" type="text" placeholder="Tên">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="con-field" name="email" id="email2" type="text"
                                        placeholder="Email">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="con-field" name="phone" id="phone" type="text"
                                        placeholder="Điện thoại">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="con-field" name="website" id="website" type="text"
                                        placeholder="Trang Web">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <textarea class="con-field" name="message" id="message2" rows="6"
                                        placeholder="Nội Dung"></textarea>
                                    <div class="submit-area">
                                        <input type="submit" class="submit-contact" value="Gửi">
                                        <div id="msg" class="message"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End:Contact Form  -->
                </div>

                <div class="col-sm-12 map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.023938894304!2d-81.38341548467582!3d19.324767486945657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f2587a9a0b98737%3A0x38fe616bb6df631f!2s638+W+Bay+Rd%2C+Cayman+Islands!5e0!3m2!1sen!2sus!4v1549260798680"></iframe>
                </div>
            </div>
            <!-- row /- -->
        </div>
    </div>
    <!-- container /- -->
</section>
<!--   End: contact US  Section
==================================================-->

@endsection
