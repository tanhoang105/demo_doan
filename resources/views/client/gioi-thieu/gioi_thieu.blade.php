@extends('Client.templates.layout')
@section('title') - About
@endsection
@section('content')

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="pt-5">
                <div>
                    <h3 style="text-align: center">GIỚI THIỆU</h3>
                </div>

                <div>
                    <ul>
                        <li class="text-dark">Học Với Chuyên Gia là chương trình đào tạo nguồn lực công nghệ thông tin chất lượng cao, bao gồm nhiều khoá học: online, offline ngắn hạn, bootcamp nhằm giúp bạn trở thành lập trình viên chuyên nghiệp trong thời gian ngắn nhất.</li>

                        <br>

                        <li class="text-dark">Bạn muốn học xong phải làm được việc? Bạn muốn học xong được cam kết 100% giới thiệu nơi thực tập hay hỗ trợ tìm việc?</li>

                        <br>

                        <li class="text-dark">Tất cả những mong muốn đó hoàn toàn được đáp ứng khi học tại Học Với Chuyên Gia. Đây là chương trình đào tạo được thiết kế và đúc kết từ kinh nghiệm của những chuyên gia là giảng viên đại học, trưởng ngành đào tạo, team leader… Có ít nhất 5 năm kinh nghiệm trở lên. Đối với lớp nâng cao yêu cầu có 7 năm kinh nghiệm trở lên.</li>

                        <br>

                        <li class="text-dark">Chúng tôi phát triển mô hình đào tạo dựa trên phương pháp học mô phỏng môi trường làm việc thực tế để tất cả học viên đều “nhập cuộc” nhanh chóng với xu hướng công nghệ đang thay đổi từng ngày. Học Với Chuyên Gia đặt mục tiêu đào tạo học viên vững kiến thức, giỏi kỹ năng, đáp ứng toàn diện yêu cầu công việc và tự tin chinh phục những nhà tuyển dụng khó tính nhất</li>

                        <br>
                    </ul>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('plugins/assets/img/about.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Họ cung cấp cho những thú vui xứng đáng nhất, như thể những thú vui của thể xác đã được giả định.</h3>
                    <p class="fst-italic">
                        Điều quan trọng là phải chăm sóc bệnh nhân, được bác sĩ theo dõi, nhưng đó là khoảng thời gian rất đau đớn và đau khổ.
                    </p>
                    <ul>
                        <li class="text-dark">- Bên cạnh các kiến thức chuyên sâu, Học Với Chuyên Gia cung cấp một môi trường học tập và thực hành gần gũi với thực tế doanh nghiệp. Bạn sẽ được học với đội ngũ giảng viên, lập trình viên nhiều năm trong nghề, tinh thần trách nhiệm cao để hướng đến mục tiêu đào tạo ra những thế hệ lập trình viên trẻ tài năng.</li>
                        <li class="text-dark">- Sau khi hoàn thành khoá học, chúng tôi cam kết giới thiệu cơ hội việc làm. Mục tiêu của chúng tôi là 100% học viên theo học Học Với Chuyên Gia có công việc ổn định, rộng mở về cơ hội thăng tiến.</li>
                        <li class="text-dark">- Chúng tôi làm tất cả để bạn – học được – làm được – có việc làm – thu nhập cao và góp bàn tay xây dựng nền CNTT Việt Nam đi lên.</li>
                    </ul>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    {{-- <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Sinh viên</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Các khóa học</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Sự kiện</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Giảng viên</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section --> --}}

    {{-- <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Lời chứng thực</h2>
                <p>Họ đang nói gì</p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Đối với nhóm đối tượng, kết quả là đáng quan tâm cho đến khi hãng hàng không tiếp quản. Những người tố cáo, tuy nhiên, cần điều đó, và cần một số kỷ luật. Một chút mờ nhạt, nhưng luôn là một nụ cười.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Nhà thiết kế</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Tuy nhiên, thời gian xuất ngoại, tôi đã vì những tệ nạn mà tôi sẽ tức giận với nỗ lực rằng tôi sẽ trở thành kẻ mà tôi đã phải đối mặt với những tệ nạn mà tôi mong muốn trở thành mà một số người của chúng ta nên làm. chạy trốn khỏi cơn giận.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Chủ cửa hàng</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Vả, nếu ta không xuất một sợi tóc từ nhà ngươi, là điều tuyệt vời, trong đó không có một sợi tóc nào ta đem đến nhà ngươi, thì thời gian lao động ít nhất sẽ là ta ở trong nhà chúng ta.


                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Vì tôi đang trốn chạy khỏi nỗi đau đớn, không có lỗi gì trong việc xuất khẩu nhiều người.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                                <h3>John Larson</h3>
                                <h4>Doanh nhân</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Tôi sẽ đọc ai trong số họ?
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section --> --}}

</main><!-- End #main -->

@endsection
