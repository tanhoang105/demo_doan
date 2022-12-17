<footer class="footertwo-section">
    <div class="container">
        <div class="row">

            <!-- Start: logo -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer_logo">
                    <img src="{{asset('client/images/logo.png')}}" alt="">
                    <ul>
                        <li>
                            <a href="#">(+84) 392725483 </a>
                        </li>
                        <li>
                            <a href="services.html">tkw_6@gmail.com</a>
                        </li>
                        <li>
                            <a href="services.html">Trịnh Văn Bô</a>
                        </li>
                    </ul>
                    <div class="footer_socil">
                        <ul>
                            <li>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End: logo -->

            <!-- Start: Quick Link -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="foo_widgetquick_lnk">
                    <h5>Danh mục</h5>
                    <ul>
                        <li>
                            <a href="{{ route('client_chinh_sach') }}">Chính sách</a>
                        </li>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="{{ route('client_giang_vien') }}">Giảng viên</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End: Quick Link -->

            <!-- Start: Useful Link -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="foo_widgetuseful_lnk">
                    <h5>Liên kết hữu ích</h5>
                    <ul>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Tham khảo một người bạn</a>
                        </li>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Scolarship</a>
                        </li>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Tiếp thị</a>
                        </li>
                        <li>
                            <a href="{{ route('client_gioi_thieu') }}">Các khóa học miễn phí</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End: Social Link-->

            <!-- Start: Contact Form -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="foo_widget footer_contact_form">
                    <h5>Gửi tin nhắn</h5>
                    <form method="post" action="https://santhemes.com/tidytheme/aducat/mailer.php">
                        <input class="con-field" name="email" id="email" type="text" placeholder="Email của bạn">
                        <textarea class="con-field" name="email" id="message"
                            placeholder="Your Message"> </textarea>
                        <input type="submit" id="submit-contact" class="btn-alt" value="Gửi">
                    </form>
                </div>
            </div>
            <!-- End: Contact Form-->
        </div>
    </div>
    <!-- Start:Subfooter -->
    <div class="subfooter">
        <p> Copyright © 2022 <a href="index-2.html">Aducat.</a> All rights Reserved.</p>
    </div>
    <!-- End:Subfooter -->
</footer>